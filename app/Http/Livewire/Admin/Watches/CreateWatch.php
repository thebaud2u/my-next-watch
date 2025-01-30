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
	public $active = 8;
	public $steps = [1, 2, 3, 4, 5, 6, 7, 8];

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

	// Crown
	public CrownColor $newCrownColor;
	public $crownColorName;
	public $crownColor = [];

	public CrownMaterial $newCrownMaterial;
	public $crownMaterialName;
	public $crownMaterial = [];

	public $crownDetail;
	public $crownScrewedDown = true;

	// Bezel
	public BezelColor $newBezelColor;
	public $bezelColorName;
	public $bezelColor = [];

	public BezelMarking $newBezelMarking;
	public $bezelMarkingName;
	public $bezelMarking = [];

	public BezelMaterial $newBezelMaterial;
	public $bezelMaterialName;
	public $bezelMaterial = [];

	public $bezelDirection = 'unidirectional';

	// Specification
	public Complication $newComplication;
	public $complicationName;
	public $specificationComplication = [];
	public $specificationPowerReserve;

	// Dial
	public DialColor $newDialColor;
	public $dialColorName;
	public $dialColor = [];

	public DialMarkerColor $newDialMarkerColor;
	public $dialMarkerColorName;
	public $dialMarkerColor = [];

	public DialMarkerLumeColor $newDialMarkerLumeColor;
	public $dialMarkerLumeColorName;
	public $dialMarkerLumeColor = [];

	public DialMarkerType $newDialMarkerType;
	public $dialMarkerTypeName;
	public $dialMarkerType = [];

	public $dialDomed = false;
	public $dialMarkerLume = false;
	public $dialTextured = false;

	// Crystal
	public CrystalMaterial $newCrystalMaterial;
	public $crystalMaterialName;
	public $crystalMaterial = [];

	public $crystalDomed = true;

	// Bracelet
	public BraceletClasp $newBraceletClasp;
	public $braceletClaspName;
	public $braceletClasp = [];

	public BraceletClaspColor $newBraceletClaspColor;
	public $braceletClaspColorName;
	public $braceletClaspColor = [];

	public BraceletClaspMaterial $newBraceletClaspMaterial;
	public $braceletClaspMaterialName;
	public $braceletClaspMaterial = [];

	public BraceletMaterial $newBraceletMaterial;
	public $braceletMaterialName;
	public $braceletMaterial = [];

	public BraceletMicroAdjustementSystem $newBraceletMicroAdjustementSystem;
	public $braceletMicroAdjustementSystemName;
	public $braceletMicroAdjustementSystem;

	public BraceletStitchingColor $newBraceletStitchingColor;
	public $braceletStitchingColorName;
	public $braceletStitchingColor = [];

	public BraceletStyle $newBraceletStyle;
	public $braceletStyleName;
	public $braceletStyle;

	public $braceletMicroAdjustement = true;
	public $braceletStitching = false;

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

			// Crown
			'crownColor' => ['array'],
			'crownColorName' => [],
			'crownDetail' => [],
			'crownMaterialName' => [],
			'crownMaterial' => ['array'],
			'crownScrewedDown' => [],

			// Bezel
			'bezelColorName' => [],
			'bezelColor' => ['array'],
			'bezelMarkingName' => [],
			'bezelMarking' => ['array'],
			'bezelMaterialName' => [],
			'bezelMaterial' => ['array'],
			'bezelDirection' => [],

			// Specification
			'complicationName' => [],
			'specificationComplication' => ['array'],
			'specificationPowerReserve' => [],

			// Dial
			'dialColorName' => [],
			'dialColor' => ['array'],
			'dialMarkerColorName' => [],
			'dialMarkerColor' => ['array'],
			'dialMarkerLumeColorName' => [],
			'dialMarkerLumeColor' => ['array'],
			'dialMarkerTypeName' => [],
			'dialMarkerType' => ['array'],
			'dialDomed' => [],
			'dialMarkerLume' => [],
			'dialTextured' => [],

			// Crystal
			'crystalDomed' => [],
			'crystalMaterial' => ['array']
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

	public function createComplication()
	{
		$rules = [
			'complicationName' => ['required']
		];

		$messages = [
			'complicationName.required' => __('The :field is mandatory', ['field' => __('movement\'s nationality')])
		];

		$this->validate($rules, $messages);

		$this->newComplication->name = $this->complicationName;
		$this->newComplication->admin_id = Auth::guard('admin')->user()->id;
		$this->newComplication->save();

		$this->newComplication = new Complication;

		$this->complications = Complication::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('complication'))]));

		$this->dispatch('complication-created');
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

	public function createCrownColor()
	{
		$rules = [
			'crownColorName' => ['required']
		];

		$messages = [
			'crownColorName.required' => __('The :field is mandatory', ['field' => 'crown color name'])
		];

		$this->validate($rules, $messages);

		$this->newCrownColor->name = $this->crownColorName;
		$this->newCrownColor->admin_id = Auth::guard('admin')->user()->id;
		$this->newCrownColor->save();

		$this->newCrownColor = new CrownColor;

		$this->crownColors = CrownColor::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('crown color'))]));

		$this->dispatch('crown-color-created');
	}

	public function createCrownMaterial()
	{
		$rules = [
			'crownMaterialName' => ['required']
		];

		$messages = [
			'crownMaterialName.required' => __('The :field is mandatory', ['field' => 'crown material name'])
		];

		$this->validate($rules, $messages);

		$this->newCrownMaterial->name = $this->crownMaterialName;
		$this->newCrownMaterial->admin_id = Auth::guard('admin')->user()->id;
		$this->newCrownMaterial->save();

		$this->newCrownMaterial = new CrownMaterial;

		$this->crownMaterials = CrownMaterial::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('crown material'))]));

		$this->dispatch('crown-material-created');
	}

	public function createBezelColor()
	{
		$rules = [
			'bezelColorName' => ['required']
		];

		$messages = [
			'bezelColorName.required' => __('The :field is mandatory', ['field' => 'bezel color name'])
		];

		$this->validate($rules, $messages);

		$this->newBezelColor->name = $this->bezelColorName;
		$this->newBezelColor->admin_id = Auth::guard('admin')->user()->id;
		$this->newBezelColor->save();

		$this->newBezelColor = new BezelColor;

		$this->bezelColors = BezelColor::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bezel color'))]));

		$this->dispatch('bezel-color-created');
	}

	public function createBezelMarking()
	{
		$rules = [
			'bezelMarkingName' => ['required']
		];

		$messages = [
			'bezelMarkingName.required' => __('The :field is mandatory', ['field' => 'bezel marking name'])
		];

		$this->validate($rules, $messages);

		$this->newBezelMarking->name = $this->bezelMarkingName;
		$this->newBezelMarking->admin_id = Auth::guard('admin')->user()->id;
		$this->newBezelMarking->save();

		$this->newBezelMarking = new BezelMarking;

		$this->crownMaterials = BezelMarking::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bezel marking'))]));

		$this->dispatch('bezel-marking-created');
	}

	public function createBezelMaterial()
	{
		$rules = [
			'bezelMaterialName' => ['required']
		];

		$messages = [
			'bezelMaterialName.required' => __('The :field is mandatory', ['field' => 'bezel material name'])
		];

		$this->validate($rules, $messages);

		$this->newBezelMaterial->name = $this->bezelMaterialName;
		$this->newBezelMaterial->admin_id = Auth::guard('admin')->user()->id;
		$this->newBezelMaterial->save();

		$this->newBezelMaterial = new BezelMaterial;

		$this->crownMaterials = BezelMaterial::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bezel material'))]));

		$this->dispatch('bezel-material-created');
	}

	public function createDialColor()
	{
		$rules = [
			'dialColorName' => ['required']
		];

		$messages = [
			'dialColorName.required' => __('The :field is mandatory', ['field' => 'dial color name'])
		];

		$this->validate($rules, $messages);

		$this->newDialColor->name = $this->dialColorName;
		$this->newDialColor->admin_id = Auth::guard('admin')->user()->id;
		$this->newDialColor->save();

		$this->newDialColor = new DialColor;

		$this->dialColors = DialColor::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('dial color'))]));

		$this->dispatch('dial-color-created');
	}

	public function createDialMarkerColor()
	{
		$rules = [
			'dialMarkerColorName' => ['required']
		];

		$messages = [
			'dialMarkerColorName.required' => __('The :field is mandatory', ['field' => 'dial marker color name'])
		];

		$this->validate($rules, $messages);

		$this->newDialMarkerColor->name = $this->dialMarkerColorName;
		$this->newDialMarkerColor->admin_id = Auth::guard('admin')->user()->id;
		$this->newDialMarkerColor->save();

		$this->newDialMarkerColor = new DialMarkerColor;

		$this->dialMarkerColors = DialMarkerColor::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('dial marker color'))]));

		$this->dispatch('dial-marker-color-created');
	}

	public function createDialMarkerLumeColor()
	{
		$rules = [
			'dialMarkerLumeColorName' => ['required']
		];

		$messages = [
			'dialMarkerLumeColorName.required' => __('The :field is mandatory', ['field' => 'dial marker lume color name'])
		];

		$this->validate($rules, $messages);

		$this->newDialMarkerLumeColor->name = $this->dialMarkerLumeColorName;
		$this->newDialMarkerLumeColor->admin_id = Auth::guard('admin')->user()->id;
		$this->newDialMarkerLumeColor->save();

		$this->newDialMarkerLumeColor = new DialMarkerLumeColor;

		$this->dialMarkerLumeColors = DialMarkerLumeColor::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('dial marker lume color'))]));

		$this->dispatch('dial-marker-lume-color-created');
	}

	public function createDialMarkerType()
	{
		$rules = [
			'dialMarkerTypeName' => ['required']
		];

		$messages = [
			'dialMarkerTypeName.required' => __('The :field is mandatory', ['field' => 'dial marker type name'])
		];

		$this->validate($rules, $messages);

		$this->newDialMarkerType->name = $this->dialMarkerTypeName;
		$this->newDialMarkerType->admin_id = Auth::guard('admin')->user()->id;
		$this->newDialMarkerType->save();

		$this->newDialMarkerType = new DialMarkerType;

		$this->dialMarkerTypes = DialMarkerType::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('dial marker type'))]));

		$this->dispatch('dial-marker-lume-color-created');
	}

	public function createCrystalMaterial()
	{
		$rules = [
			'crystalMaterialName' => ['required']
		];

		$messages = [
			'crystalMaterialName.required' => __('The :field is mandatory', ['field' => 'crystal material name'])
		];

		$this->validate($rules, $messages);

		$this->newCrystalMaterial->name = $this->crystalMaterialName;
		$this->newCrystalMaterial->admin_id = Auth::guard('admin')->user()->id;
		$this->newCrystalMaterial->save();

		$this->newCrystalMaterial = new CrystalMaterial;

		$this->crystalMaterials = CrystalMaterial::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('crystal material'))]));

		$this->dispatch('crystal-material-created');
	}

	public function createBraceletClasp()
	{
		$rules = [
			'braceletClaspName' => ['required']
		];

		$messages = [
			'braceletClaspName.required' => __('The :field is mandatory', ['field' => 'clasp name'])
		];

		$this->validate($rules, $messages);

		$this->newBraceletClasp->name = $this->braceletClaspName;
		$this->newBraceletClasp->admin_id = Auth::guard('admin')->user()->id;
		$this->newBraceletClasp->save();

		$this->newBraceletClasp = new BraceletClaps;

		$this->braceletClasps = BraceletClaps::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bracelet clasp'))]));

		$this->dispatch('bracelet-clasp-created');
	}

	public function createBraceletClaspColor()
	{
		$rules = [
			'braceletClaspColorName' => ['required']
		];

		$messages = [
			'braceletClaspColorName.required' => __('The :field is mandatory', ['field' => 'clasp color name'])
		];

		$this->validate($rules, $messages);

		$this->newBraceletClaspColor->name = $this->braceletClaspColorName;
		$this->newBraceletClaspColor->admin_id = Auth::guard('admin')->user()->id;
		$this->newBraceletClaspColor->save();

		$this->newBraceletClaspColor = new ClaspColor;

		$this->claspColors = ClaspColor::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bracelet clasp color'))]));

		$this->dispatch('bracelet-clasp-color-created');
	}

	public function createBraceletClaspMaterial()
	{
		$rules = [
			'braceletClaspMaterialName' => ['required']
		];

		$messages = [
			'braceletClaspMaterialName.required' => __('The :field is mandatory', ['field' => 'clasp material name'])
		];

		$this->validate($rules, $messages);

		$this->newBraceletClaspMaterial->name = $this->braceletClaspMaterialName;
		$this->newBraceletClaspMaterial->admin_id = Auth::guard('admin')->user()->id;
		$this->newBraceletClaspMaterial->save();

		$this->newBraceletClaspMaterial = new BraceletClaspMaterial;

		$this->braceletClaspMaterials = BraceletClaspMaterial::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bracelet clasp material'))]));

		$this->dispatch('bracelet-clasp-material-created');
	}

	public function createBraceletMaterial()
	{
		$rules = [
			'braceletMaterialName' => ['required']
		];

		$messages = [
			'braceletMaterialName.required' => __('The :field is mandatory', ['field' => 'bracelet material name'])
		];

		$this->validate($rules, $messages);

		$this->newBraceletMaterial->name = $this->braceletMaterialName;
		$this->newBraceletMaterial->admin_id = Auth::guard('admin')->user()->id;
		$this->newBraceletMaterial->save();

		$this->newBraceletMaterial = new BraceletMaterial;

		$this->braceletMaterials = BraceletMaterial::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bracelet material'))]));

		$this->dispatch('bracelet-material-created');
	}

	public function createBraceletMicroAdjustementSystem()
	{
		$rules = [
			'braceletMicroAdjustementSystemName' => ['required']
		];

		$messages = [
			'braceletMicroAdjustementSystemName.required' => __('The :field is mandatory', ['field' => 'micro adjustement system name'])
		];

		$this->validate($rules, $messages);

		$this->newBraceletMicroAdjustementSystem->name = $this->braceletMicroAdjustementSystemName;
		$this->newBraceletMicroAdjustementSystem->admin_id = Auth::guard('admin')->user()->id;
		$this->newBraceletMicroAdjustementSystem->save();

		$this->newBraceletMicroAdjustementSystem = new BraceletMicroAdjustementSystem;

		$this->braceletMicroAdjustementSystems = BraceletMicroAdjustementSystem::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bracelet micro adjustement system'))]));

		$this->dispatch('bracelet-micro-adjustement-system-created');
	}

	public function createBraceletStitchingColor()
	{
		$rules = [
			'braceletStitchingColorName' => ['required']
		];

		$messages = [
			'braceletStitchingColorName.required' => __('The :field is mandatory', ['field' => 'stitching color name'])
		];

		$this->validate($rules, $messages);

		$this->newBraceletStitchingColor->name = $this->braceletStitchingColorName;
		$this->newBraceletStitchingColor->admin_id = Auth::guard('admin')->user()->id;
		$this->newBraceletStitchingColor->save();

		$this->newBraceletStitchingColor = new BraceletStitchingColor;

		$this->braceletStitchingColors = BraceletStitchingColor::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bracelet stitching color'))]));

		$this->dispatch('bracelet-stitching-color-created');
	}

	public function createBraceletStyle()
	{
		$rules = [
			'braceletStyleName' => ['required']
		];

		$messages = [
			'braceletStyleName.required' => __('The :field is mandatory', ['field' => 'style name'])
		];

		$this->validate($rules, $messages);

		$this->newBraceletStyle->name = $this->braceletStyleName;
		$this->newBraceletStyle->admin_id = Auth::guard('admin')->user()->id;
		$this->newBraceletStyle->save();

		$this->newBraceletStyle = new BraceletStyle;

		$this->braceletStyles = BraceletStyle::all();

		session()->flash('success', __(':element created successfully', ['element' => ucfirst(__('bracelet style'))]));

		$this->dispatch('bracelet-style-created');
	}

	public function updateWatch()
	{
		if($this->active == 1) {
			$rules = [
				'watchCollection' => ['required'],
				'watchName' => ['required'],
				'watchReference' => ['required']
			];

			$messages = [
				'watchCollection.required' => __('The :field is mandatory', ['field' => __('collection')]),
				'watchName.required' => __('The :field is mandatory', ['field' => __('name')]),
				'watchReference.required' => __('The :field is mandatory', ['field' => __('reference')])
			];
		}
		else if($this->active == 2) {
			$rules = [
				'watchMovement' => ['required'],
				'specificationComplication' => ['required'],
				'specificationPowerReserve' => ['required']
			];

			$messages = [
				'watchMovement.required' => __('The :field is mandatory', ['field' => __('movement')]),
				'specificationComplication.required' => __('The :field is mandatory', ['field' => __('complication')]),
				'specificationPowerReserve.required' => __('The :field is mandatory', ['field' => __('power reserve')])
			];
		}
		else if($this->active == 3) {
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
		else if($this->active == 4) {
			$rules = [
				'crownColor' => ['required'],
				'crownDetail' => ['required'],
				'crownMaterial' => ['required']
			];

			$messages = [
				'crownColor.required' => __('The :field is mandatory', ['field' => __('crown color')]),
				'crownDetail.required' => __('The :field is mandatory', ['field' => __('crown detail')]),
				'crownMaterial.required' => __('The :field is mandatory', ['field' => __('crown material')])
			];
		}
		else if($this->active == 5) {
			$rules = [
				'bezelColor' => ['required'],
				'bezelMarking' => ['required'],
				'bezelMaterial' => ['required']
			];

			$messages = [
				'bezelColor.required' => __('The :field is mandatory', ['field' => __('bezel color')]),
				'bezelMarking.required' => __('The :field is mandatory', ['field' => __('bezel marking')]),
				'bezelMaterial.required' => __('The :field is mandatory', ['field' => __('bezel material')])
			];
		}
		else if($this->active == 6) {
			$rules = [
				'dialColor' => ['required'],
				'dialMarkerColor' => ['required'],
				'dialMarkerLumeColor' => ['required'],
				'dialMarkerType' => ['required'],
				'dialDomed' => ['required'],
				'dialMarkerLume' => ['required'],
				'dialTextured' => ['required']
			];

			$messages = [
				'bezelColor.required' => __('The :field is mandatory', ['field' => __('bezel color')]),
				'bezelMarking.required' => __('The :field is mandatory', ['field' => __('bezel marking')]),
				'bezelMaterial.required' => __('The :field is mandatory', ['field' => __('bezel material')])
			];
		}
		else if($this->active == 7) {
			$rules = [
				'crystalMaterial' => ['required']
			];

			$messages = [
				'crystalMaterial.required' => __('The :field is mandatory', ['field' => __('crystal material')])
			];
		}
		else if($this->active == 8) {
			$rules = [
				'braceletClasp' => ['required'],
				'braceletClaspColor' => ['required'],
				'braceletClaspMaterial' => ['required'],
				'braceletMaterial' => ['required'],
				'braceletMicroAdjustement' => ['boolean'],
				'braceletMicroAdjustementSystem' => ['exclude_unless:braceletMicroAdjustement,true', 'required'],
				'braceletStitching' => ['boolean'],
				'braceletStitchingColor' => ['exclude_unless:braceletStitching,true', 'required'],
				'braceletStyle' => ['required']
			];

			$messages = [
				'braceletClasp.required' => __('The :field is mandatory', ['field' => __('crystal material')]),
				'braceletClaspColor.required' => __('The :field is mandatory', ['field' => __('crystal material')]),
				'braceletClaspMaterial.required' => __('The :field is mandatory', ['field' => __('crystal material')]),
				'braceletMaterial.required' => __('The :field is mandatory', ['field' => __('crystal material')]),
				'braceletMicroAdjustementSystem.required' => __('The :field is mandatory', ['field' => __('crystal material')]),
				'braceletStitchingColor.required' => __('The :field is mandatory', ['field' => __('crystal material')]),
				'braceletStyle.required' => __('The :field is mandatory', ['field' => __('crystal material')]),
			];
		}

		$this->validate($rules, $messages);

		if($this->active == 1) {
			$this->watch->collection_id = $this->watchCollection;
			$this->watch->name = $this->watchName;
			$this->watch->reference = $this->watchReference;
		}
		else if($this->active == 2) {
			$this->watch->movement_id = $this->watchMovement;
			$this->watch->specification['complication'] = $this->specificationComplication;
			$this->watch->specification['power_reserve'] = $this->specificationPowerReserve;
		}
		else if($this->active == 3) {
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
		else if($this->active == 4) {
			$this->watch->crown['color'] = $this->crownColor;
			$this->watch->crown['detail'] = $this->crownDetail;
			$this->watch->crown['material'] = $this->crownMaterial;
			$this->watch->crown['screwed_down'] = $this->crownScrewedDown;
		}
		else if($this->active == 5) {
			$this->watch->bezel['color'] = $this->bezelColor;
			$this->watch->bezel['direction'] = $this->bezelDirection;
			$this->watch->bezel['marking'] = $this->bezelMarking;
			$this->watch->bezel['material'] = $this->bezelMaterial;
		}
		else if($this->active == 6) {
			$this->watch->dial['color'] = $this->dialColor;
			$this->watch->dial['domed'] = $this->dialDomed;
			$this->watch->dial['marker_color'] = $this->dialMarkerColor;
			$this->watch->dial['marker_lume'] = $this->dialMarkerLume;
			$this->watch->dial['marker_lume_color'] = $this->dialMarkerLumeColor;
			$this->watch->dial['marker_type'] = $this->dialMarkerType;
			$this->watch->dial['textured'] = $this->dialTextured;
		}
		else if($this->active == 7) {
			$this->watch->crystal['domed'] = $this->crystalDomed;
			$this->watch->crystal['material'] = $this->crystalMaterial;
		}
		else if($this->active == 8) {
			$this->watch->bracelet['clasp'] = $this->braceletClasp;
			$this->watch->bracelet['clasp_color'] = $this->braceletClaspColor;
			$this->watch->bracelet['clasp_material'] = $this->braceletClaspMaterial;
			$this->watch->bracelet['material'] = $this->braceletMaterial;
			$this->watch->bracelet['micro_adjustement'] =  $this->braceletMicroAdjustement;
			$this->watch->bracelet['micro_adjustement_system'] = $this->braceletMicroAdjustementSystem;
			$this->watch->bracelet['stitching'] = $this->braceletStitching;
			$this->watch->bracelet['stitching_color'] = $this->braceletStitchingColor;
			$this->watch->bracelet['style'] = $this->braceletStyle;
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

		// Init the watch's values
		if($this->watch->collection) {
			$this->selectedBrand = $this->watch->collection->brand->id;
			$this->brandSelected();

			$this->watchCollection = $this->watch->collection->id;
		}

		$this->watchName = $this->watch->name;
		$this->watchReference = $this->watch->reference;

		if($this->watch->movement) $this->watchMovement = $this->watch->movement->id;
		$this->specificationComplication = $this->watch->specification['complication'];
		$this->specificationPowerReserve = $this->watch->specification['power_reserve'];

		$this->caseColor = $this->watch->case['color'];
		$this->caseDiameter = $this->watch->case['diameter'];
		$this->caseLugToLug = $this->watch->case['lug_to_lug'];
		$this->caseLugWidth = $this->watch->case['lug_width'];
		$this->caseMaterial = $this->watch->case['material'];
		$this->caseOpenCaseBack = $this->watch->case['open_case_back'];
		$this->caseSapphireCrystalCaseBack = $this->watch->case['sapphire_crystal_case_back'];
		$this->caseThickness = $this->watch->case['thickness'];
		$this->caseWaterproofness = $this->watch->case['waterproofness'];

		$this->crownColor = $this->watch->crown['color'];
		$this->crownDetail = $this->watch->crown['detail'];
		$this->crownMaterial = $this->watch->crown['material'];
		$this->crownScrewedDown = $this->watch->crown['screwed_down'];

		$this->bezelColor = $this->watch->bezel['color'];
		$this->bezelDirection = $this->watch->bezel['direction'];
		$this->bezelMarking = $this->watch->bezel['marking'];
		$this->bezelMaterial = $this->watch->bezel['material'];

		$this->dialColor = $this->watch->dial['color'];
		$this->dialMarkerColor = $this->watch->dial['marker_color'];
		$this->dialMarkerLumeColor = $this->watch->dial['marker_lume_color'];
		$this->dialMarkerType = $this->watch->dial['marker_type'];
		$this->dialDomed = $this->watch->dial['domed'];
		$this->dialMarkerLume = $this->watch->dial['marker_lume'];
		$this->dialTextured = $this->watch->dial['textured'];

		$this->crystalDomed = $this->watch->crystal['domed'];
		$this->crystalMaterial = $this->watch->crystal['material'];

		$this->braceletClasp = $this->watch->bracelet['clasp'];
		$this->braceletClaspColor = $this->watch->bracelet['clasp_color'];
		$this->braceletClaspMaterial = $this->watch->bracelet['clasp_material'];
		$this->braceletMaterial = $this->watch->bracelet['material'];
		$this->braceletMicroAdjustement = $this->watch->bracelet['micro_adjustement'];
		$this->braceletMicroAdjustementSystem = $this->watch->bracelet['micro_adjustement_system'];
		$this->braceletStitching = $this->watch->bracelet['stitching'];
		$this->braceletStitchingColor = $this->watch->bracelet['stitching_color'];
		$this->braceletStyle = $this->watch->bracelet['style'];
	}

	public function render()
	{
		return view('livewire.admin.watches.create-watch');
	}
}
