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
	public $fields = [];
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
				$when->whereHas('collection.brand.country', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['country']);
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
				$when->where('case->open_case_back', (bool) $this->filters['case_open_case_back']);
			})
			->when(!is_null($this->filters['case_sapphire_crystal_case_back']), function($when) {
				$when->where('case->sapphire_crystal_case_back', (bool) $this->filters['case_sapphire_crystal_case_back']);
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
				$when->where('crystal->domed', (bool) $this->filters['crystal_domed']);
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
				$when->where('crown->detail', $this->filters['crown_detail']);
			})
			->when(count($this->filters['crown_material']) > 0, function($when) {
				$when->whereHas('crownMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['crown_material']);
				});
			})
			->when(!is_null($this->filters['crown_screwed_down']), function($when) {
				$when->where('crown->screwed_down', (bool) $this->filters['crown_screwed_down']);
			})
			// Dial filters
			->when(count($this->filters['dial_color']) > 0, function($when) {
				$when->whereHas('dialColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_color']);
				});
			})
			->when(!is_null($this->filters['dial_domed']), function($when) {
				$when->where('dial->domed', (bool) $this->filters['dial_domed']);
			})
			->when(count($this->filters['dial_marker_color']) > 0, function($when) {
				$when->whereHas('dialMarkerColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_marker_color']);
				});
			})
			->when(!is_null($this->filters['dial_marker_lume']), function($when) {
				$when->where('dial->marker_lume', (bool) $this->filters['dial_marker_lume']);
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
				$when->where('dial->skeleton', (bool) $this->filters['dial_skeleton']);
			})
			->when(!is_null($this->filters['dial_textured']), function($when) {
				$when->where('dial->textured', (bool) $this->filters['dial_textured']);
			})
			// Bracelet type filters
			->when(count($this->filters['bracelet_type']) > 0, function($when) {
				$when->whereHas('braceletMaterials.braceletType', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_type']);
				});
			})
			// Bracelet filters
			->when(!is_null($this->filters['bracelet_micro_adjustement']), function($when) {
				$when->where('bracelet->micro_adjustement', (bool) $this->filters['bracelet_micro_adjustement']);
			})
			->when(!is_null($this->filters['bracelet_stitching']), function($when) {
				$when->where('bracelet->stitching', (bool) $this->filters['bracelet_stitching']);
			})
			->when(count($this->filters['bracelet_clasp']) > 0, function($when) {
				$when->whereHas('braceletClasp', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_clasp']);
				});
			})
			->when(count($this->filters['bracelet_clasp_color']) > 0, function($when) {
				$when->whereHas('braceletClaspColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_clasp_color']);
				});
			})
			->when(count($this->filters['bracelet_clasp_material']) > 0, function($when) {
				$when->whereHas('braceletClaspMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_clasp_material']);
				});
			})
			->when(count($this->filters['bracelet_color']) > 0, function($when) {
				$when->whereHas('braceletColor', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_color']);
				});
			})
			->when(count($this->filters['bracelet_material']) > 0, function($when) {
				$when->whereHas('braceletMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_material']);
				});
			})
			->when(count($this->filters['bracelet_micro_adjustement_system']) > 0, function($when) {
				$when->whereHas('braceletMicroAdjustementSystem', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_micro_adjustement_system']);
				});
			})
			->when(count($this->filters['bracelet_stitching_color']) > 0, function($when) {
				$when->whereHas('braceletStitchingColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_stitching_color']);
				});
			})
			->when(count($this->filters['bracelet_style']) > 0, function($when) {
				$when->whereHas('braceletStyle', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_style']);
				});
			});
	}

	private function loadModel($model, $watchIds, $hasToGoThrough = null)
	{
		return $model::whereHas(is_null($hasToGoThrough) ? 'watches' : $hasToGoThrough, function($whereHas) use($watchIds) {
				$whereHas->whereIn('watches.id', $watchIds);
			})
			->orderBy('name')
			->pluck('name', 'id');
	}

	private function loadJson(string $field, $watchesData, bool $keepNull = false)
	{
		return $watchesData
			->pluck($field)
			->when(!$keepNull, fn($c) => $c->filter())
			->when($keepNull, fn($c) => $c->filter(fn($v) => !is_null($v)))
			->unique()
			->sort()
			->values();
	}

	private function proceed($changedField, $fields)
	{
		//dd($fields);
		$fieldKeys = array_keys($fields);

		if($changedField !== null) {
			$index = array_search($changedField, $fieldKeys);
			// Vide tous les filtres APRÈS le champ qui vient de changer
			foreach(array_slice($fieldKeys, $index + 1) as $laterField) {
				$this->filters[$laterField] = is_array($this->filters[$laterField]) ? [] : null;
			}
		}

		$watchesData = $this->watchesDataQuery()
			->get();

		//dd($watchesData);

		foreach($fields as $field => $loader) {
			$value = $this->filters[$field] ?? null;
			$isEmpty = isset($loader['boolean'])
				? is_null($value)
				: empty($value);

			if($isEmpty) {
				if($loader['type'] == 'entity') $data = $this->loadModel($loader['model'], $watchesData->pluck('id'), isset($loader['hasToGoThrough']) ? $loader['hasToGoThrough'] : null);
				elseif($loader['type'] == 'json') $data = $this->loadJson($loader['field'], $watchesData, isset($loader['boolean']) ? $loader['boolean'] : false);

				$this->data[$field] = $data;

				if($data->count() === 1) {
					if(isset($loader['boolean'])) $this->filters[$field] = $data->first();
					else $this->filters[$field] = $loader['type'] === 'entity' ? $data->keys()->toArray() : $data->toArray();
					continue;
				}

				break;
			}
		}

		//dd($this->data);
	}

	public function finderUpdated($changedField = null)
	{
		$this->proceed($changedField, $this->fields);
	}

	public function braceletSteps($changedField = null)
	{
		if(count($this->filters['bracelet_type']) > 0) {
			$braceletFields = [];

			if(in_array('1', $this->filters['bracelet_type'])) {
				$braceletFields['bracelet_material'] = [
					'type' => 'entity',
					'model' => BraceletMaterial::class
				];

				$braceletFields['bracelet_micro_adjustement'] = [
					'type' => 'json',
					'field' => 'bracelet.micro_adjustement',
					'boolean' => true
				];

				$braceletFields['bracelet_micro_adjustement_system'] = [
					'type' => 'entity',
					'model' => BraceletMicroAdjustementSystem::class
				];
			}

			if(in_array('2', $this->filters['bracelet_type'])) {
				$braceletFields['bracelet_stitching'] = [
					'type' => 'json',
					'field' => 'bracelet.stitching',
					'boolean' => true
				];

				$braceletFields['bracelet_stitching_color'] = [
					'type' => 'entity',
					'model' => BraceletStitchingColor::class
				];
			}

			$braceletFields['bracelet_color'] = [
				'type' => 'entity',
				'model' => BraceletColor::class
			];

			$braceletFields['bracelet_style'] = [
				'type' => 'entity',
				'model' => BraceletStyle::class
			];

			$braceletFields['bracelet_clasp'] = [
				'type' => 'entity',
				'model' => BraceletClasp::class
			];

			$braceletFields['bracelet_clasp_color'] = [
				'type' => 'entity',
				'model' => BraceletClaspColor::class
			];

			$braceletFields['bracelet_clasp_material'] = [
				'type' => 'entity',
				'model' => BraceletClaspMaterial::class
			];

			$this->proceed($changedField, $braceletFields);
		}
	}

	public function mount()
	{
		$this->fields = [
			'country' => [
				'type' => 'entity',
				'model' => Country::class,
				'hasToGoThrough' => 'brands.watches'
			],
			'case_diameter' => [
				'type' => 'json',
				'field' => 'case.diameter'
			],
			'case_thickness' => [
				'type' => 'json',
				'field' => 'case.thickness'
			],
			'case_lug_width' => [
				'type' => 'json',
				'field' => 'case.lug_width'
			],
			'case_lug_to_lug' => [
				'type' => 'json',
				'field' => 'case.lug_to_lug'
			],
			'case_material' => [
				'type' => 'entity',
				'model' => CaseMaterial::class
			],
			'case_color' => [
				'type' => 'entity',
				'model' => CaseColor::class
			],
			'case_open_case_back' => [
				'type' => 'json',
				'field' => 'case.open_case_back',
				'boolean' => true,
			],
			'case_sapphire_crystal_case_back' => [
				'type' => 'json',
				'field' => 'case.sapphire_crystal_case_back',
				'boolean' => true,
			],
			'case_waterproofness' => [
				'type' => 'json',
				'field' => 'case.waterproofness'
			],
			'bezel_direction' => [
				'type' => 'json',
				'field' => 'bezel.direction'
			],
			'bezel_color' => [
				'type' => 'entity',
				'model' => BezelColor::class
			],
			'bezel_marking' => [
				'type' => 'entity',
				'model' => BezelMarking::class
			],
			'bezel_material' => [
				'type' => 'entity',
				'model' => BezelMaterial::class
			],
			'crystal_domed' => [
				'type' => 'json',
				'field' => 'crystal.domed',
				'boolean' => true
			],
			'crystal_material' => [
				'type' => 'entity',
				'model' => CrystalMaterial::class
			],
			'crown_color' => [
				'type' => 'entity',
				'model' => CrownColor::class
			],
			'crown_detail' => [
				'type' => 'json',
				'field' => 'crown.detail'
			],
			'crown_material' => [
				'type' => 'entity',
				'model' => CrownMaterial::class
			],
			'crown_screwed_down' => [
				'type' => 'json',
				'field' => 'crown.screwed_down',
				'boolean' => true
			],
			'dial_domed' => [
				'type' => 'json',
				'field' => 'dial.domed',
				'boolean' => true
			],
			'dial_skeleton' => [
				'type' => 'json',
				'field' => 'dial.skeleton',
				'boolean' => true
			],
			'dial_textured' => [
				'type' => 'json',
				'field' => 'dial.textured',
				'boolean' => true
			],
			'dial_color' => [
				'type' => 'entity',
				'model' => DialColor::class
			],
			'dial_marker_type' => [
				'type' => 'entity',
				'model' => DialMarkerType::class
			],
			'dial_marker_color' => [
				'type' => 'entity',
				'model' => DialMarkerColor::class
			],
			'dial_marker_lume' => [
				'type' => 'json',
				'field' => 'dial.marker_lume',
				'boolean' => true
			],
			'dial_marker_lume_color' => [
				'type' => 'entity',
				'model' => DialMarkerLumeColor::class
			],
			'bracelet_type' => [
				'type' => 'entity',
				'model' => BraceletType::class,
				'hasToGoThrough' => 'braceletMaterials.watches'
			]
		];

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
		$this->filters['bracelet_color'] = [];
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

		$this->data['type'] = Type::orderBy('name', 'ASC')->get();

		if(session()->has('filters')) {
			$sessionFilters = session()->get('filters');

			foreach($sessionFilters as $key => $filter) {
				if(!empty($sessionFilters[$key])) $this->filters[$key] = $sessionFilters[$key];
			}
		}
	}

	public function render()
	{
		return view('livewire.front.finder.filters');
	}
}
