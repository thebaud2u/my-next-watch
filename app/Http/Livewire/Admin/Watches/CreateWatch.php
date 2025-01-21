<?php

namespace App\Http\Livewire\Admin\Watches;

use Auth;
use DB;
use Rule;

use Livewire\Component;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Collection;
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

	// Data
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

	// Temp variables
	public $selectedBrand;
	public $watchCaseColor = [];
	public $watchCaseMaterial = [];
	// Mediable id (create)
	public $modelId;

	// Entities
	public Brand $brand;
	public Brand $newBrand;
	public Collection $newCollection;
	public Mediable $mediable;
	public Movement $newMovement;
	public Watch $newWatch;

	public CaseColor $newCaseColor;
	public CaseMaterial $newCaseMaterial;

	protected function rules()
	{
		return [
			'selectedBrand' => [],
			'newBrand.name' => [],
			'newBrand.description' => [],
			'newBrand.nationality' => [],
			'newBrand.external_link' => [],

			'watchCaseColor' => ['array'],
			'watchCaseMaterial' => ['array'],

			'newCollection.name' => [],

			'newMovement.name' => [],
			'newMovement.type' => [],
			'newMovement.COSC' => [],
			'newMovement.METAS' => [],
			'newMovement.manufactured_caliber' => [],
			'newMovement.description' => [],
			'newMovement.nationality' => [],

			'newWatch.collection_id' => [],
			'newWatch.name' => [],
			'newWatch.reference' => [],
			'newWatch.movement_id' => [],
			'newWatch.case.color' => ['array'],
			'newWatch.case.material' => ['array'],

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
			'newBrand.name' => ['required'],
			'newBrand.description' => ['required'],
			'newBrand.nationality' => ['required'],
			'newBrand.external_link' => ['required']
		];

		$messages = [
			'newBrand.name.required' => __('The brand\'s name is mandatory'),
			'newBrand.description.required' => __('The brand\'s description is mandatory'),
			'newBrand.nationality.required' => __('The brand\'s nationality is mandatory'),
			'newBrand.external_link.required' => __('The brand\'s website is mandatory'),
		];

		$this->validate($rules, $messages);

		$this->newBrand->admin_id = Auth::guard('admin')->user()->id;
		$this->newBrand->save();

		$this->newBrand = new Brand;
		// To use uploader for the new Brand logo, since it's a new brand, it doesn't have an id yet.
		$this->mediable = Mediable::firstOrCreate([
			'admin_id' => Auth::guard('admin')->user()->id,
			'type' => 'brand'
		]);
		$this->modelId = $this->mediable->id;

		$this->brands = Brand::all();

		$this->dispatch('brand-created');
	}

	public function createCollection()
	{
		$rules = [
			'newCollection.name' => ['required']
		];

		$messages = [
			'newCollection.name.required' => __('The collection\'s name is mandatory')
		];

		$this->validate($rules, $messages);

		$this->newCollection->selectedBrand = $this->brand->id;
		$this->newCollection->admin_id = Auth::guard('admin')->user()->id;
		$this->newCollection->save();

		$this->newCollection = new Collection;

		$this->collections = Collection::all();

		$this->dispatch('collection-created');
	}

	public function createMovement()
	{
		$rules = [
			'newMovement.name' => ['required'],
			'newMovement.type' => ['required'],
			'newMovement.nationality' => ['required']
		];

		$messages = [
			'newMovement.name.required' => __('The :field is mandatory', ['field' => 'movement\'s name']),
			'newMovement.type.required' => __('The :field is mandatory', ['field' => 'movement\'s type']),
			'newMovement.nationality.required' => __('The :field is mandatory', ['field' => 'movement\'s nationality'])
		];

		$this->validate($rules, $messages);

		$this->newMovement->selectedBrand = $this->brand->id;
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

	// Init
	public function mount()
	{
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
		// To use uploader for the new Brand logo, since it's a new brand, it doesn't have an id yet.
		$this->mediable = Mediable::firstOrCreate([
			'admin_id' => Auth::guard('admin')->user()->id,
			'type' => 'brand'
		]);
		$this->modelId = $this->mediable->id;

		$this->newCollection = new Collection;
		$this->newMovement = new Movement;
		$this->newWatch = new Watch;

		$this->newCaseColor = new CaseColor;
		$this->newCaseMaterial = new CaseMaterial;
	}

	public function render()
	{
		return view('livewire.admin.watches.create-watch');
	}
}
