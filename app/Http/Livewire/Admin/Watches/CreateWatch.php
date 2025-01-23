<?php

namespace App\Http\Livewire\Admin\Watches;

use Auth;
use DB;
use Rule;

use Livewire\Component;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Media;
use App\Models\Mediable;
use App\Models\Movement;
use App\Models\Watch;

use App\Models\WatchDetails\ {
	BezelColor, BezelMarking, BezelMaterial, BraceletClasp, BraceletClaspColor, BraceletClaspMaterial, BraceletColor, BraceletMaterial,
	BraceletMicroAdjustementSystem, BraceletStitchingColor, BraceletStyle, CaseColor, CaseMaterial, Complication, CrownColor, CrownMaterial,
	CrystalMaterial, DialColor, DialMarkerColor, DialMarkerLumeColor, DialMarkerType
};

class CreateWatch extends Component
{
	public $active = 1;
	public $steps = [1, 2, 3, 4, 5, 6, 7];

	// Eloquent Collections
	public $brands;
	public $collections;
	public $movements;

	public $bezelColors;
	public $bezelMarkings;
	public $bezelMaterials;
	public $braceletClasps;
	public $braceletClaspColors;
	public $braceletClaspMaterials;
	public $braceletColors;
	public $braceletMaterials;
	public $braceletMicroAdjustementSystems;
	public $braceletStitchingColors;
	public $braceletStyles;
	public $caseColors;
	public $caseMaterials;
	public $complications;
	public $crownColors;
	public $crownMaterials;
	public $crystalMaterials;
	public $dialColors;
	public $dialMarkerColors;
	public $dialMarkerLumeColors;
	public $dialMarkerTypes;

	// Properties
	public $selectedBrand;
	public Brand $brand;
	public Brand $newBrand;
	public $brandName;
	public $brandLogo;
	public $brandDescription;
	public $brandNationality;
	public $brandExternalLink;

	public Collection $newCollection;
	public $collectionName;

	public Movement $newMovement;
	public $movementName;
	public $movementType;
	public $movementCOSC = false;
	public $movementMETAS = false;
	public $movementManufacturedCaliber = false;
	public $movementDescription;
	public $movementNationality;

	public Watch $watch;
	public $collectionId;
	public $watchName;
	public $watchReference;
	public $movementId;

	public $watchCaseColor = [];
	public $watchCaseMaterial = [];

	// Mediable id (create)
	public $modelId;

	// Models
	public Mediable $mediable;


	public CaseColor $newCaseColor;
	public CaseMaterial $newCaseMaterial;

	protected function rules()
	{
		return [
			'selectedBrand' => [],
			'brandName' => [],
			'brandDescription' => [],
			'brandNationality' => [],
			'brandExternalLink' => [],

			'watchCaseColor' => ['array'],
			'watchCaseMaterial' => ['array'],

			'collectionName' => [],

			'movementName' => [],
			'movementType' => [],
			'movementCOSC' => [],
			'movementMETAS' => [],
			'movementManufacturedCaliber' => [],
			'movementDescription' => [],
			'movementNationality' => [],

			'watch.collection_id' => [],
			'watch.name' => [],
			'watch.reference' => [],
			'watch.movement_id' => [],
			'watch.case.color' => ['array'],
			'watch.case.material' => ['array'],

			'newCaseColor.name' => [],
		];
	}

	// Listeners
	public function back()
	{
		$this->active--;
	}

	public function goto($index)
	{
		$this->active = $index;
	}

	public function brandSelected()
	{
		if($this->selectedBrand != '') {
			$this->brand = Brand::find($this->selectedBrand);

			$this->collections = Collection::whereHas('brand', function($whereHas) {
					$whereHas->where('id', $this->brand->id);
				})
				->get();

			$this->movements = Movement::whereHas('brand', function($whereHas) {
					$whereHas->where('id', $this->brand->id);
				})
				->get();
		}
	}

	// Forms
	public function createBrand()
	{
		$rules = [
			'brandName' => ['required'],
			'brandNationality' => ['required'],
			'brandExternalLink' => ['required']
		];

		$messages = [
			'brandName.required' => __('The brand\'s name is mandatory'),
			'brandNationality.required' => __('The brand\'s nationality is mandatory'),
			'brandExternalLink.required' => __('The brand\'s website is mandatory')
		];

		$this->validate($rules, $messages);

		$this->newBrand->name = $this->brandName;
		$this->newBrand->nationality = $this->brandNationality;
		$this->newBrand->admin_id = Auth::guard('admin')->user()->id;
		$this->newBrand->save();

		// Transfer the logo
		$medias = $this->mediable->getMedia('logo');
		if(!empty($medias)) {
			foreach($medias as $temp_media) {
				if($media = Media::findOrFail($temp_media->id)) $media->move($this->newBrand, 'logo');
			}
		}

		// To use uploader for the new Brand logo, since it's a new brand, it doesn't have an id yet.
		$this->mediable = Mediable::firstOrCreate([
			'admin_id' => Auth::guard('admin')->user()->id,
			'type' => 'brand'
		]);
		$this->modelId = $this->mediable->id;

		$this->brands = Brand::all();

		session()->flash('success', __('Brand created successfully'));

		$this->dispatch('brand-created');
	}

	public function createCollection()
	{
		$rules = [
			'collectionName' => ['required']
		];

		$messages = [
			'collectionName.required' => __('The collection\'s name is mandatory')
		];

		$this->validate($rules, $messages);

		$this->newCollection->brand_id = $this->brand->id;
		$this->newCollection->name = $this->collectionName;
		$this->newCollection->admin_id = Auth::guard('admin')->user()->id;
		$this->newCollection->save();

		$this->newCollection = new Collection;

		$this->collections = Collection::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('collection'))]));

		$this->dispatch('collection-created');
	}

	public function createMovement()
	{
		$rules = [
			'movementName' => ['required'],
			'movementType' => ['required'],
			'movementNationality' => ['required']
		];

		$messages = [
			'movementName.required' => __('The :field is mandatory', ['field' => 'movement\'s name']),
			'movementType.required' => __('The :field is mandatory', ['field' => 'movement\'s type']),
			'movementNationality.required' => __('The :field is mandatory', ['field' => 'movement\'s nationality'])
		];

		$this->validate($rules, $messages);

		$this->newMovement->brand_id = $this->brand->id;
		$this->newMovement->name = $this->movementName;
		$this->newMovement->type = $this->movementType;
		$this->newMovement->COSC = $this->movementCOSC;
		$this->newMovement->METAS = $this->movementMETAS;
		$this->newMovement->manufactured_caliber = $this->movementManufacturedCaliber;
		$this->newMovement->description = $this->movementDescription;
		$this->newMovement->nationality = $this->movementNationality;
		$this->newMovement->admin_id = Auth::guard('admin')->user()->id;
		$this->newMovement->save();

		$this->newMovement = new Movement;

		$this->movements = Movement::all();

		$this->dispatch('movement-created');
	}

	public function createCaseColor()
	{
		$rules = [
			'newCaseColor.name' => ['required']
		];

		$messages = [
			'newCaseColor.name.required' => __('The :field is mandatory', ['field' => 'case color name'])
		];

		$this->validate($rules, $messages);

		$this->newCaseColor->admin_id = Auth::guard('admin')->user()->id;
		$this->newCaseColor->save();

		$this->newCaseColor = new CaseColor;

		$this->caseColors = CaseColor::all();

		$this->dispatch('case-color-created');
	}

	public function createCaseMaterial()
	{
		$rules = [
			'newCaseMaterial.name' => ['required']
		];

		$messages = [
			'newCaseMaterial.name.required' => __('The :field is mandatory', ['field' => 'case color name'])
		];

		$this->validate($rules, $messages);

		$this->newCaseMaterial->admin_id = Auth::guard('admin')->user()->id;
		$this->newCaseMaterial->save();

		$this->newCaseMaterial = new CaseMaterial;

		$this->caseMaterials = CaseMaterial::all();

		$this->dispatch('case-material-created');
	}

	public function updateWatch()
	{
		if($this->active == 1) {
			$rules = [
				'watch.collection_id' => ['required'],
				'watch.movement_id' => ['required'],
				'watch.name' => ['required'],
				'watch.reference' => ['required']
			];

			$messages = [
				'watch.collection_id.required' => __('The :field is mandatory', ['field' => 'collection']),
				'watch.movement_id.required' => __('The :field is mandatory', ['field' => 'movement']),
				'watch.name.required' => __('The :field is mandatory', ['field' => 'name']),
				'watch.reference.required' => __('The :field is mandatory', ['field' => 'reference'])
			];
		}



		$this->validate($rules, $messages);

		$this->watch->save();

		$this->active++;
	}

	// Init
	public function mount(Watch $watch)
	{
		$this->watch = $watch;

		// Load lists
		$this->brands = Brand::all();
		$this->bezelColors = BezelColor::all();
		$this->bezelMarkings = BezelMarking::all();
		$this->bezelMaterials = BezelMaterial::all();
		$this->braceletClasps = BraceletClasp::all();
		$this->braceletClaspColors = BraceletClaspColor::all();
		$this->braceletClaspMaterials = BraceletClaspMaterial::all();
		$this->braceletColors = BraceletColor::all();
		$this->braceletMaterials = BraceletMaterial::all();
		$this->braceletMicroAdjustementSystems = BraceletMicroAdjustementSystem::all();
		$this->braceletStitchingColors = BraceletStitchingColor::all();
		$this->braceletStyles = BraceletStyle::all();
		$this->caseColors = CaseColor::all();
		$this->caseMaterials = CaseMaterial::all();
		$this->complications = Complication::all();
		$this->crownColors = CrownColor::all();
		$this->crownMaterials = CrownMaterial::all();
		$this->crystalMaterials = CrystalMaterial::all();
		$this->dialColors = DialColor::all();
		$this->dialMarkerColors = DialMarkerColor::all();
		$this->dialMarkerLumeColors = DialMarkerLumeColor::all();
		$this->dialMarkerTypes = DialMarkerType::all();

		$this->newBrand = new Brand;
		$this->newCollection = new Collection;
		$this->newMovement = new Movement;
		// To use uploader for the new Brand logo, since it's a new brand, it doesn't have an id yet.
		$this->mediable = Mediable::firstOrCreate([
			'admin_id' => Auth::guard('admin')->user()->id,
			'type' => 'brand'
		]);
		$this->modelId = $this->mediable->id;

		if(!is_null($this->watch->collection->id)) {
			$this->selectedBrand = $this->watch->collection->brand->id;
			$this->brandSelected();
		}

		$this->collectionId = $this->watch->collection->id;
		$this->watchName = $this->watch->name;
		$this->watchReference = $this->watch->reference;
		$this->movementId = $this->watch->movement->id;
	}

	public function render()
	{
		return view('livewire.admin.watches.create-watch');
	}
}
