<?php

namespace App\Http\Livewire\Front\Finder;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\{Brand, Collection, Country, Movement, Type, Watch};
use App\Models\WatchDetails\ {
	BezelColor, BezelMarking, BezelMaterial, BraceletClasp, BraceletClaspColor, BraceletClaspMaterial, BraceletColor, BraceletMaterial,
	BraceletMicroAdjustementSystem, BraceletStitchingColor, BraceletStyle,
	CaseColor, CaseMaterial, Complication, CrownColor, CrownMaterial, CrystalMaterial,
	DialColor, DialMarkerColor, DialMarkerLumeColor, DialMarkerType
};

class Filters extends Component
{
	public $activeStep = 1;
	public $totalSteps = 5;
	public $filters = [];
	public $data = [];

	public function finderUpdated()
	{
		$watchesData = Watch::
			// Generalities filters
			when(count($this->filters['type']) > 0, function($when) {
				$when->whereHas('types', function($whereHasTypes) {
					$whereHasTypes->whereIn('slug', $this->filters['type']);
				});
			})
			->when(count($this->filters['country']) > 0, function($when) {
				$when->whereHas('collection', function($whereHasCollection) {
					$whereHasCollection->whereHas('brand', function($whereHasBrand) {
						$whereHasBrand->whereHas('address', function($whereHasAddress) {
							$whereHasAddress->whereHas('country', function($whereHasCountry) {
								$whereHasCountry->whereIn('id', $this->filters['country']);
							});
						});
					});
				});
			})
			// Case dimensions filters
			->when(count($this->filters['case_diameter']) > 0, function($when) {
				$when->whereIn('case->diameter', $this->filters['case_diameter']);
			})
			->when(count($this->filters['case_thickness']) > 0, function($when) {
				$when->whereIn('case->thickness', $this->filters['case_thickness']);
			})
			->when(count($this->filters['case_lug_to_lug']) > 0, function($when) {
				$when->whereIn('case->lug_to_lug', $this->filters['case_lug_to_lug']);
			})
			->when(count($this->filters['case_lug_width']) > 0, function($when) {
				$when->whereIn('case->lug_width', $this->filters['case_lug_width']);
			})
			// Case color, material and case back details filters
			->when(count($this->filters['case_color']) > 0, function($when) {
				$when->whereHas('caseColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['case_color']);
				});
			})
			->when(count($this->filters['case_material']) > 0, function($when) {
				$when->whereHas('caseMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['case_material']);
				});
			})
			->when(count($this->filters['case_open_case_back']) > 0, function($when) {
				$booleans = array_map(fn($v) => (bool) $v, $this->filters['case_open_case_back']);
				$when->whereIn('case->open_case_back', $booleans);
			})
			->when(count($this->filters['case_sapphire_crystal_case_back']) > 0, function($when) {
				$booleans = array_map(fn($v) => (bool) $v, $this->filters['case_sapphire_crystal_case_back']);
				$when->whereIn('case->sapphire_crystal_case_back', $booleans);
			})
			->when(count($this->filters['case_waterproofness']) > 0, function($when) {
				$when->whereIn('case->waterproofness', $this->filters['case_waterproofness']);
			})
			// Bezel filters
			->when(count($this->filters['bezel_direction']) > 0, function($when) {
				$when->whereIn('bezel->direction', $this->filters['bezel_direction']);
			})
			->when(count($this->filters['bezel_color']) > 0, function($when) {
				$when->whereHas('bezelColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bezel_color']);
				});
			})
			->when(count($this->filters['bezel_marking']) > 0, function($when) {
				$when->whereHas('bezelMarkings', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bezel_marking']);
				});
			})
			->when(count($this->filters['bezel_material']) > 0, function($when) {
				$when->whereHas('bezelMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bezel_material']);
				});
			})
			// Crystal filters
			->when(count($this->filters['crystal_domed']) > 0, function($when) {
				$booleans = array_map(fn($v) => (bool) $v, $this->filters['crystal_domed']);
				$when->whereIn('crystal->domed', $booleans);
			})
			->when(count($this->filters['crystal_material']) > 0, function($when) {
				$when->whereHas('crystalMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['crystal_material']);
				});
			})
			// Crown filters
			->get();

		// If on generalities filters step, update only the case filters
		if($this->activeStep == 1) {
			$fields = [
				'diameter',
				'thickness',
				'lug_to_lug',
				'lug_width'
			];

			foreach($fields as $field) {
				$this->data["case_$field"] = $watchesData
					->pluck("case.$field")
					->filter()
					->unique()
					->sort()
					->values();
			}
		}
		// If on case dimensions filters step, update only the case color, material and case back details filters
		elseif($this->activeStep == 2) {
			$fields = [
				'open_case_back',
				'sapphire_crystal_case_back',
			];

			foreach($fields as $field) {
				$this->data["case_$field"] = $watchesData
					->pluck("case.$field")
					->filter(fn($value) => !is_null($value))
					->unique()
					->sort()
					->values();
			}

			$this->data['case_waterproofness'] = $watchesData
				->pluck('case.waterproofness')
				->filter()
				->unique()
				->sort()
				->values();

			$watchIds = $watchesData->pluck('id');
			$this->data['case_color'] = CaseColor::whereHas('watches', function($whereHasWatches) use($watchIds) {
					$whereHasWatches->whereIn('watches.id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['case_material'] = CaseMaterial::whereHas('watches', function($whereHasWatches) use($watchIds) {
					$whereHasWatches->whereIn('watches.id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');
		}
		// If on case color, material and case back details filters step, update only the bezel filters
		elseif($this->activeStep == 3) {
			$this->data['bezel_direction'] = $watchesData
				->pluck('bezel.direction')
				->filter()
				->unique()
				->sort()
				->values();

			$watchIds = $watchesData->pluck('id');
			$this->data['bezel_color'] = BezelColor::whereHas('watches', function($whereHasWatches) use($watchIds) {
					$whereHasWatches->whereIn('watches.id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['bezel_marking'] = BezelMarking::whereHas('watches', function($whereHasWatches) use($watchIds) {
					$whereHasWatches->whereIn('watches.id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['bezel_material'] = BezelMaterial::whereHas('watches', function($whereHasWatches) use($watchIds) {
					$whereHasWatches->whereIn('watches.id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');
		}
		// If on bezel filters step, update only the crystal filters
		elseif($this->activeStep == 4) {
			$this->data['crystal_domed'] = $watchesData
				->pluck('crystal.domed')
				->filter(fn($value) => !is_null($value))
				->unique()
				->sort()
				->values();

			$watchIds = $watchesData->pluck('id');
			$this->data['crystal_material'] = CrystalMaterial::whereHas('watches', function($whereHasWatches) use($watchIds) {
					$whereHasWatches->whereIn('watches.id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');
		}
	}

	public function goToStep($index)
	{
		$this->activeStep = $index;
	}

	public function nextStep()
	{
		if($this->activeStep < $this->totalSteps) $this->activeStep++;
	}

	public function previousStep()
	{
		$this->activeStep--;
	}

	public function mount()
	{
		$this->filters['keyword'] = null;
		$this->filters['country'] = [];
		$this->filters['type'] = [];
		$this->filters['min_price'] = null;
		$this->filters['max_price'] = null;
		$this->filters['complication'] = [];
		$this->filters['power_reserve'] = [];

		// Bezel filters
		$this->filters['bezel_color'] = [];
		$this->filters['bezel_direction'] = [];
		$this->filters['bezel_marking'] = [];
		$this->filters['bezel_material'] = [];

		// Bracelet filters
		$this->filters['bracelet_clasp'] = [];
		$this->filters['bracelet_clasp_color'] = [];
		$this->filters['bracelet_clasp_material'] = [];
		$this->filters['bracelet_material'] = [];
		$this->filters['bracelet_micro_adjustement'] = [];
		$this->filters['bracelet_micro_adjustement_system'] = [];
		$this->filters['bracelet_stitching'] = [];
		$this->filters['bracelet_stitching_color'] = [];
		$this->filters['bracelet_style'] = [];

		// Case filters
		$this->filters['case_color'] = [];
		$this->filters['case_diameter'] = [];
		$this->filters['case_lug_to_lug'] = [];
		$this->filters['case_lug_width'] = [];
		$this->filters['case_material'] = [];
		$this->filters['case_open_case_back'] = [];
		$this->filters['case_sapphire_crystal_case_back'] = [];
		$this->filters['case_thickness'] = [];
		$this->filters['case_waterproofness'] = [];

		// Crown filters
		$this->filters['crown_color'] = [];
		$this->filters['crown_detail'] = [];
		$this->filters['crown_material'] = [];
		$this->filters['crown_screwed_down'] = [];

		// Crystal filters
		$this->filters['crystal_domed'] = [];
		$this->filters['crystal_material'] = [];

		// Dial filters
		$this->filters['dial_color'] = [];
		$this->filters['dial_domed'] = [];
		$this->filters['dial_marker_color'] = [];
		$this->filters['dial_marker_lume'] = [];
		$this->filters['dial_marker_lume_color'] = [];
		$this->filters['dial_marker_type'] = [];
		$this->filters['dial_textured'] = [];

		if(session()->has('filters')) {
			$sessionFilters = session()->get('filters');

			foreach($sessionFilters as $key => $filter) {
				if(!empty($sessionFilters[$key])) $this->filters[$key] = $sessionFilters[$key];
			}
		}

		$this->data['types'] = Type::orderBy('name', 'ASC')->get();
		$this->data['countries'] = Country::whereIn('code', ['FRA', 'USA', 'CHE', 'JPN', 'GBR'])->get();
	}

	public function render()
	{
		return view('livewire.front.finder.filters');
	}
}
