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
	// Brand
	public $selectedBrand;
	public Brand $brand;
	public Brand $newBrand;
	public $brandName;
	public $brandLogo;
	public $brandDescription;
	public $brandNationality;
	public $brandExternalLink;

	// Collection
	public $watchCollection;
	public Collection $newCollection;
	public $collectionName;

	// Watch
	public Watch $watch;
	public $watchName;
	public $watchReference;

	// Movement
	public $watchMovement;
	public Movement $newMovement;
	public $movementName;
	public $movementType;
	public $movementCOSC = false;
	public $movementMETAS = false;
	public $movementManufacturedCaliber = false;
	public $movementDescription;
	public $movementNationality;

	// Case
	public CaseColor $newCaseColor;
	public $caseColorName;
	public $caseColor = [];

	public CaseMaterial $newCaseMaterial;
	public $caseMaterialName;
	public $caseMaterial = [];

	public $caseDiameter;
	public $caseLugToLug;
	public $caseLugWidth;
	public $caseOpenCaseBack = false;
	public $caseSapphireCrystalCaseBack = false;
	public $caseThickness;
	public $caseWaterproofness;

	public Mediable $mediable;
	// Mediable id (create)
	public $modelId;

	protected function rules()
	{
		return [
			// Brand
			'selectedBrand' => [],
			'brandName' => [],
			'brandDescription' => [],
			'brandNationality' => [],
			'brandExternalLink' => [],

			// Collection
			'watchCollection' => [],
			'collectionName' => [],

			// Watch
			'watchName' => [],
			'watchReference' => [],

			// Movement
			'watchMovement' => [],
			'movementName' => [],
			'movementType' => [],
			'movementCOSC' => [],
			'movementMETAS' => [],
			'movementManufacturedCaliber' => [],
			'movementDescription' => [],
			'movementNationality' => [],

			// Case
			'caseColor' => ['array'],
			'caseColorName' => [],
			'caseDiameter' => [],
			'caseLugToLug' => [],
			'caseLugWidth' => [],
			'caseMaterial' => ['array'],
			'caseMaterialName' => [],
			'caseOpenCaseBack' => [],
			'caseSapphireCrystalCaseBack' => [],
			'caseThickness' => [],
			'caseWaterproofness' => [],
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
			'brandName.required' => __('The :field is mandatory', ['field' => __('brand\'s name')]),
			'brandNationality.required' => __('The :field is mandatory', ['field' => __('brand\'s nationality')]),
			'brandExternalLink.required' => __('The :field is mandatory', ['field' => __('brand\'s website')])
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

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('brand'))]));

		$this->dispatch('brand-created');
	}

	public function createCollection()
	{
		$rules = [
			'collectionName' => ['required']
		];

		$messages = [
			'collectionName.required' => __('The :field is mandatory', ['field' => __('collection\'s name')])
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
			'movementName.required' => __('The :field is mandatory', ['field' => __('movement\'s name')]),
			'movementType.required' => __('The :field is mandatory', ['field' => __('movement\'s type')]),
			'movementNationality.required' => __('The :field is mandatory', ['field' => __('movement\'s nationality')])
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

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('movement'))]));

		$this->dispatch('movement-created');
	}

	public function createCaseColor()
	{
		$rules = [
			'caseColorName' => ['required']
		];

		$messages = [
			'caseColorName.required' => __('The :field is mandatory', ['field' => 'case color name'])
		];

		$this->validate($rules, $messages);

		$this->newCaseColor->name = $this->caseColorName;
		$this->newCaseColor->admin_id = Auth::guard('admin')->user()->id;
		$this->newCaseColor->save();

		$this->newCaseColor = new CaseColor;

		$this->caseColors = CaseColor::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('case color'))]));

		$this->dispatch('case-color-created');
	}

	public function createCaseMaterial()
	{
		$rules = [
			'caseMaterialName' => ['required']
		];

		$messages = [
			'caseMaterialName.required' => __('The :field is mandatory', ['field' => 'case material name'])
		];

		$this->validate($rules, $messages);

		$this->newCaseMaterial->name = $this->caseMaterialName;
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
				'watchCollection' => ['required'],
				'watchName' => ['required'],
				'watchReference' => ['required'],
				'watchMovement' => ['required']
			];

			$messages = [
				'watchCollection.required' => __('The :field is mandatory', ['field' => __('collection')]),
				'watchName.required' => __('The :field is mandatory', ['field' => __('name')]),
				'watchReference.required' => __('The :field is mandatory', ['field' => __('reference')]),
				'watchMovement.required' => __('The :field is mandatory', ['field' => __('movement')])
			];
		}
		else if($this->active == 2) {
			$rules = [
				'caseColor' => ['required'],
				'caseDiameter' => ['required'],
				'caseLugToLug' => ['required'],
				'caseLugWidth' => ['required'],
				'caseMaterial' => ['required'],
				'caseThickness' => ['required'],
				'caseWaterproofness' => ['required']
			];

			$messages = [
				'caseColor.required' => __('The :field is mandatory', ['field' => __('case color')]),
				'caseDiameter.required' => __('The :field is mandatory', ['field' => __('diameter')]),
				'caseLugToLug.required' => __('The :field is mandatory', ['field' => __('lug to lug')]),
				'caseLugWidth.required' => __('The :field is mandatory', ['field' => __('lug width')]),
				'caseMaterial.required' => __('The :field is mandatory', ['field' => __('case material')]),
				'caseThickness.required' => __('The :field is mandatory', ['field' => __('thickness')]),
				'caseWaterproofness.required' => __('The :field is mandatory', ['field' => __('waterproofness')])
			];
		}

		$this->validate($rules, $messages);

		if($this->active == 1) {
			$this->watch->collection_id = $this->watchCollection;
			$this->watch->name = $this->watchName;
			$this->watch->reference = $this->watchReference;
			$this->watch->movement_id = $this->watchMovement;
		}
		else if($this->active == 2) {
			$this->watch->case['color'] = $this->caseColor;
			$this->watch->case['diameter'] = $this->caseDiameter;
			$this->watch->case['lug_to_lug'] = $this->caseLugToLug;
			$this->watch->case['lug_width'] = $this->caseLugWidth;
			$this->watch->case['material'] = $this->caseMaterial;
			$this->watch->case['open_case_back'] = $this->caseOpenCaseBack;
			$this->watch->case['sapphire_crystal_case_back'] = $this->caseSapphireCrystalCaseBack;
			$this->watch->case['thickness'] = $this->caseThickness;
			$this->watch->case['waterproofness'] = $this->caseWaterproofness;
		}

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

		if($this->watch->collection) {
			$this->selectedBrand = $this->watch->collection->brand->id;
			$this->brandSelected();

			$this->watchCollection = $this->watch->collection->id;
		}

		if($this->watch->movement) $this->watchMovement = $this->watch->movement->id;

		$this->watchName = $this->watch->name;
		$this->watchReference = $this->watch->reference;
		$this->caseColor = $this->watch->case['color'];
		$this->caseDiameter = $this->watch->case['diameter'];
		$this->caseLugToLug = $this->watch->case['lug_to_lug'];
		$this->caseLugWidth = $this->watch->case['lug_width'];
		$this->caseMaterial = $this->watch->case['material'];
		$this->caseOpenCaseBack = $this->watch->case['open_case_back'];
		$this->caseSapphireCrystalCaseBack = $this->watch->case['sapphire_crystal_case_back'];
		$this->caseThickness = $this->watch->case['thickness'];
		$this->caseWaterproofness = $this->watch->case['waterproofness'];
	}

	public function render()
	{
		return view('livewire.admin.watches.create-watch');
	}
}
