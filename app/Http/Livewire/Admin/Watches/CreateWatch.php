<?php

namespace App\Http\Livewire\Admin\Watches;

use Auth;
use DB;
use Rule;

use Livewire\Component;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Collection;
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
	public $brand_id;
	public $watchCaseColor = [];
	public $watchCaseMaterial = [];

	// Entities
	public Brand $brand;
	public Collection $newCollection;
	public Movement $newMovement;
	public Watch $newWatch;

	public CaseColor $newCaseColor;
	public CaseMaterial $newCaseMaterial;

	protected function rules()
	{
		return [

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
		if($this->brand_id != '') {
			$this->brand = Brand::find($this->brand_id);

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
	public function createCollection()
	{
		$rules = [
			'newCollection.name' => ['required']
		];

		$messages = [
			'newCollection.name.required' => __('The collection\'s name is mandatory')
		];

		$this->validate($rules, $messages);

		$this->newCollection->brand_id = $this->brand->id;
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

		$this->newMovement->brand_id = $this->brand->id;
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

		$this->newCollection = new Collection;
		$this->newMovement = new Movement;
		$this->newWatch = new Watch;
		$this->newWatch->name = 'caca';
		$this->newWatch->reference = 'pipi';

		$this->newCaseColor = new CaseColor;
		$this->newCaseMaterial = new CaseMaterial;
	}

	public function render()
	{
		return view('livewire.admin.watches.create-watch');
	}
}
