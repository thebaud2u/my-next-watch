<?php

namespace App\Http\Livewire\Front\Finder;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\{Brand, Collection, Country, Movement, Type, Watch};
use App\Models\WatchDetails\ {
	BezelColor, BezelMarking, BezelMaterial, BraceletClasp, BraceletClaspColor, BraceletClaspMaterial, BraceletColor, BraceletMaterial,
	BraceletMicroAdjustementSystem, BraceletStitchingColor, BraceletStyle, BraceletType,
	CaseColor, CaseMaterial, Complication, CrownColor, CrownMaterial, CrystalMaterial,
	DialColor, DialMarkerColor, DialMarkerLumeColor, DialMarkerType
};

class Filters extends Component
{
	public $activeStep = 1;
	public $totalSteps = 10;
	public $filters = [];
	public $data = [];

	private function watchesDataQuery()
	{
		return Watch::
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
			->when(count($this->filters['case_lug_to_lug']) > 0, function($when) {
				$when->whereIn('case->lug_to_lug', $this->filters['case_lug_to_lug']);
			})
			->when(count($this->filters['case_lug_width']) > 0, function($when) {
				$when->whereIn('case->lug_width', $this->filters['case_lug_width']);
			})
			->when(count($this->filters['case_thickness']) > 0, function($when) {
				$when->whereIn('case->thickness', $this->filters['case_thickness']);
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
			->when(!is_null($this->filters['case_open_case_back']), function($when) {
				$when->whereIn('case->open_case_back', (bool) $this->filters['case_open_case_back']);
			})
			->when(!is_null($this->filters['case_sapphire_crystal_case_back']), function($when) {
				$when->whereIn('case->sapphire_crystal_case_back', (bool) $this->filters['case_sapphire_crystal_case_back']);
			})
			->when(count($this->filters['case_waterproofness']) > 0, function($when) {
				$when->whereIn('case->waterproofness', $this->filters['case_waterproofness']);
			})
			// Bezel filters
			->when(count($this->filters['bezel_color']) > 0, function($when) {
				$when->whereHas('bezelColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bezel_color']);
				});
			})
			->when(count($this->filters['bezel_direction']) > 0, function($when) {
				$when->whereIn('bezel->direction', $this->filters['bezel_direction']);
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
			->when(!is_null($this->filters['crystal_domed']), function($when) {
				$when->whereIn('crystal->domed', (bool) $this->filters['crystal_domed']);
			})
			->when(count($this->filters['crystal_material']) > 0, function($when) {
				$when->whereHas('crystalMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['crystal_material']);
				});
			})
			// Crown filters
			->when(count($this->filters['crown_color']) > 0, function($when) {
				$when->whereHas('crownColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['crown_color']);
				});
			})
			->when(count($this->filters['crown_detail']) > 0, function($when) {
				$when->whereIn('crown->detail', $this->filters['crown_detail']);
			})
			->when(count($this->filters['crown_material']) > 0, function($when) {
				$when->whereHas('crownMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['crown_material']);
				});
			})
			->when(!is_null($this->filters['crown_screwed_down']), function($when) {
				$when->whereIn('crown->screwed_down', (bool) $this->filters['crown_screwed_down']);
			})
			// Dial filters
			->when(count($this->filters['dial_color']) > 0, function($when) {
				$when->whereHas('dialColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_color']);
				});
			})
			->when(!is_null($this->filters['dial_domed']), function($when) {
				$when->whereIn('dial->domed', (bool) $this->filters['dial_domed']);
			})
			->when(count($this->filters['dial_marker_color']) > 0, function($when) {
				$when->whereHas('dialMarkerColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_marker_color']);
				});
			})
			->when(!is_null($this->filters['dial_marker_lume']), function($when) {
				$when->whereIn('dial->marker_lume', (bool) $this->filters['dial_marker_lume']);
			})
			->when(count($this->filters['dial_marker_lume_color']) > 0, function($when) {
				$when->whereHas('dialMarkerLumeColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_marker_lume_color']);
				});
			})
			->when(count($this->filters['dial_marker_type']) > 0, function($when) {
				$when->whereHas('dialMarkerTypes', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_marker_type']);
				});
			})
			->when(!is_null($this->filters['dial_skeleton']), function($when) {
				$when->whereIn('dial->skeleton', (bool) $this->filters['dial_skeleton']);
			})
			->when(!is_null($this->filters['dial_textured']), function($when) {
				$when->whereIn('dial->textured', (bool) $this->filters['dial_textured']);
			})
			// Bracelet type filters
			->when(count($this->filters['bracelet_type']) > 0, function($when) {
				$when->whereHas('braceletMaterials', function($whereHasBraceletMaterial) {
					$whereHasBraceletMaterial->whereHas('braceletType', function($whereHasBraceletType) {
						$whereHasBraceletType->whereIn('id', $this->filters['bracelet_type']);
					});
				});
			});
	}

	private function checkToSkip($direction)
	{
		if($this->activeStep == 2) {
			if(
				count($this->data['case_diameter']) == 1 &&
				count($this->data['case_lug_to_lug']) == 1 &&
				count($this->data['case_lug_width']) == 1 &&
				count($this->data['case_thickness']) == 1
			) {
				if($direction == 'next') $this->nextStep();
				else $this->previousStep();
			}
		}
		elseif($this->activeStep == 3) {
			if(
				count($this->data['case_color']) == 1 &&
				count($this->data['case_material']) == 1 &&
				count($this->data['case_open_case_back']) == 1 &&
				count($this->data['case_sapphire_crystal_case_back']) == 1
			) {
				if($direction == 'next') $this->nextStep();
				else $this->previousStep();
			}
		}
		elseif($this->activeStep == 4) {
			if(
				count($this->data['bezel_color']) == 1 &&
				count($this->data['bezel_direction']) == 1 &&
				count($this->data['bezel_marking']) == 1 &&
				count($this->data['bezel_material']) == 1
			) {
				if($direction == 'next') $this->nextStep();
				else $this->previousStep();
			}
		}
		elseif($this->activeStep == 5) {
			if(
				count($this->data['crystal_domed']) == 1 &&
				count($this->data['crystal_material']) == 1
			) {
				if($direction == 'next') $this->nextStep();
				else $this->previousStep();
			}
		}
		elseif($this->activeStep == 6) {
			if(
				count($this->data['crown_color']) == 1 &&
				count($this->data['crown_detail']) == 1 &&
				count($this->data['crown_material']) == 1 &&
				count($this->data['crown_screwed_down']) == 1
			) {
				if($direction == 'next') $this->nextStep();
				else $this->previousStep();
			}
		}
		elseif($this->activeStep == 7) {
			if(
				count($this->data['dial_color']) == 1 &&
				count($this->data['dial_domed']) == 1 &&
				count($this->data['dial_marker_color']) == 1 &&
				count($this->data['dial_marker_lume']) == 1 &&
				count($this->data['dial_marker_lume_color']) == 1 &&
				count($this->data['dial_marker_type']) == 1 &&
				count($this->data['dial_skeleton']) == 1 &&
				count($this->data['dial_textured']) == 1
			) {
				if($direction == 'next') $this->nextStep();
				else $this->previousStep();
			}
		}
		elseif($this->activeStep == 8) {
			if(count($this->data['bracelet_type']) == 1) {
				if($direction == 'next') $this->nextStep();
				else $this->previousStep();
			}
		}
	}

	public function finderUpdated()
	{
		$watchesData = $this->watchesDataQuery()
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
			$this->data['case_color'] = CaseColor::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['case_material'] = CaseMaterial::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
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
			$this->data['bezel_color'] = BezelColor::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['bezel_marking'] = BezelMarking::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['bezel_material'] = BezelMaterial::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
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
			$this->data['crystal_material'] = CrystalMaterial::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');
		}
		// If on crystal filters step, update only the crown filters
		elseif($this->activeStep == 5) {
			$this->data['crown_detail'] = $watchesData
				->pluck('crown.detail')
				->filter()
				->unique()
				->sort()
				->values();

			$this->data['crown_screwed_down'] = $watchesData
				->pluck('crown.screwed_down')
				->filter(fn($value) => !is_null($value))
				->unique()
				->sort()
				->values();

			$watchIds = $watchesData->pluck('id');
			$this->data['crown_color'] = CrownColor::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['crown_material'] = CrownMaterial::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');
		}
		// If on crown filters, update only dial filters
		elseif($this->activeStep == 6) {
			$fields = [
				'domed',
				'marker_lume',
				'skeleton',
				'textured'
			];

			foreach($fields as $field) {
				$this->data["dial_$field"] = $watchesData
					->pluck("dial.$field")
					->filter(fn($value) => !is_null($value))
					->unique()
					->sort()
					->values();
			}

			$watchIds = $watchesData->pluck('id');
			$this->data['dial_color'] = DialColor::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['dial_marker_color'] = DialMarkerColor::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['dial_marker_lume_color'] = DialMarkerLumeColor::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');

			$this->data['dial_marker_type'] = DialMarkerType::whereHas('watches', function($whereHas) use($watchIds) {
					$whereHas->whereIn('id', $watchIds);
				})
				->orderBy('name')
				->pluck('name', 'id');
		}
		// If on dial filters, update only bracelet type filters
		elseif($this->activeStep == 7) {
			$watchIds = $watchesData->pluck('id');
			$this->data['bracelet_type'] = BraceletType::whereHas('materials', function($whereHasMaterials) use($watchIds) {
					$whereHasMaterials->whereHas('watches', function($whereHasWatches) use($watchIds) {
						$whereHasWatches->whereIn('id', $watchIds);
					});
				})
				->orderBy('name')
				->pluck('name', 'id');
		}
		// If on bracelet type filters, update only bracelet filters
		elseif($this->activeStep == 8) {
			if(count($this->data['bracelet_type']) == 1) {
				if($this->data['bracelet_type'] == 'bracelet') {

				}
				elseif($this->data['bracelet_type'] == 'strap') {

				}
			}
			else {
				$fields = [
					'micro_adjustement',
					'stitching'
				];

				foreach($fields as $field) {
					$this->data["bracelet_$field"] = $watchesData
						->pluck("bracelet.$field")
						->filter(fn($value) => !is_null($value))
						->unique()
						->sort()
						->values();
				}

				$watchIds = $watchesData->pluck('id');
				$this->data['bracelet_clasp'] = BraceletClasp::whereHas('watches', function($whereHas) use($watchIds) {
						$whereHas->whereIn('id', $watchIds);
					})
					->orderBy('name')
					->pluck('name', 'id');

				$this->data['bracelet_clasp_color'] = BraceletClaspColor::whereHas('watches', function($whereHas) use($watchIds) {
						$whereHas->whereIn('id', $watchIds);
					})
					->orderBy('name')
					->pluck('name', 'id');

				$this->data['bracelet_clasp_material'] = BraceletClaspMaterial::whereHas('watches', function($whereHas) use($watchIds) {
						$whereHas->whereIn('id', $watchIds);
					})
					->orderBy('name')
					->pluck('name', 'id');

				$this->data['bracelet_color'] = BraceletColor::whereHas('watches', function($whereHas) use($watchIds) {
						$whereHas->whereIn('id', $watchIds);
					})
					->orderBy('name')
					->pluck('name', 'id');

				$this->data['bracelet_material'] = BraceletMaterial::whereHas('watches', function($whereHas) use($watchIds) {
						$whereHas->whereIn('id', $watchIds);
					})
					->orderBy('name')
					->pluck('name', 'id');

				$this->data['bracelet_micro_adjustement_system'] = BraceletMicroAdjustementSystem::whereHas('watches', function($whereHas) use($watchIds) {
						$whereHas->whereIn('id', $watchIds);
					})
					->orderBy('name')
					->pluck('name', 'id');

				$this->data['bracelet_stitching_color'] = BraceletStitchingColor::whereHas('watches', function($whereHas) use($watchIds) {
						$whereHas->whereIn('id', $watchIds);
					})
					->orderBy('name')
					->pluck('name', 'id');

				$this->data['bracelet_style'] = BraceletStyle::whereHas('watches', function($whereHas) use($watchIds) {
						$whereHas->whereIn('id', $watchIds);
					})
					->orderBy('name')
					->pluck('name', 'id');
			}
		}
	}

	public function goToStep($index)
	{
		$this->activeStep = $index;
	}

	public function nextStep()
	{
		if($this->activeStep < $this->totalSteps) $this->activeStep++;

		$this->finderUpdated();
		$this->checkToSkip('next');
	}

	public function previousStep()
	{
		$this->activeStep--;
		$this->finderUpdated();
		$this->checkToSkip('previous');
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
		$this->filters['bracelet_micro_adjustement'] = null;
		$this->filters['bracelet_micro_adjustement_system'] = [];
		$this->filters['bracelet_stitching'] = null;
		$this->filters['bracelet_stitching_color'] = [];
		$this->filters['bracelet_style'] = [];
		$this->filters['bracelet_type'] = [];

		// Case filters
		$this->filters['case_color'] = [];
		$this->filters['case_diameter'] = [];
		$this->filters['case_lug_to_lug'] = [];
		$this->filters['case_lug_width'] = [];
		$this->filters['case_material'] = [];
		$this->filters['case_open_case_back'] = null;
		$this->filters['case_sapphire_crystal_case_back'] = null;
		$this->filters['case_thickness'] = [];
		$this->filters['case_waterproofness'] = [];

		// Crown filters
		$this->filters['crown_color'] = [];
		$this->filters['crown_detail'] = [];
		$this->filters['crown_material'] = [];
		$this->filters['crown_screwed_down'] = null;

		// Crystal filters
		$this->filters['crystal_domed'] = null;
		$this->filters['crystal_material'] = [];

		// Dial filters
		$this->filters['dial_color'] = [];
		$this->filters['dial_domed'] = null;
		$this->filters['dial_marker_color'] = [];
		$this->filters['dial_marker_lume'] = null;
		$this->filters['dial_marker_lume_color'] = [];
		$this->filters['dial_marker_type'] = [];
		$this->filters['dial_skeleton'] = null;
		$this->filters['dial_textured'] = null;

		if(session()->has('filters')) {
			$sessionFilters = session()->get('filters');

			foreach($sessionFilters as $key => $filter) {
				if(!empty($sessionFilters[$key])) $this->filters[$key] = $sessionFilters[$key];
			}
		}

		$this->data['types'] = Type::orderBy('name', 'ASC')->get();
		$this->data['countries'] = Country::whereIn('code', ['FRA', 'USA', 'CHE', 'JPN', 'GBR'])->get();
		$this->finderUpdated();
	}

	public function render()
	{
		return view('livewire.front.finder.filters');
	}
}
