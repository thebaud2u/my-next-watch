<?php

namespace App\Http\Livewire\Front\Finder;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;

use App\Models\{
	BezelColor, BezelMarking, BezelMaterial, BraceletClasp, BraceletClaspColor, BraceletClaspMaterial, BraceletColor, BraceletMaterial,
	BraceletMicroAdjustementSystem, BraceletStitchingColor, BraceletStyle, BraceletType, Brand,
	CaseColor, CaseMaterial, Collection, Complication, CrownColor, CrownMaterial, CrystalMaterial, Country,
	DialColor, DialFinish, DialMarkerColor, DialMarkerLumeColor, DialMarkerType,
	Experience,
	Movement, MovementType,
	Type,
	Watch
};

class Index extends Component
{
	use WithPagination;

	public $askExperience = false;
	public $data = [];
	public $filters = [];
	public $mode = 'watches';
	public $session = [];
	public $showFoundWatch = false;
	public $watchSlugs = [];

	private function filteredWatchSlugs()
	{
		$this->watchSlugs = Watch::query()->pluck('slug');

		// Generalities filters
		if(count($this->filters['type']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('type', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['type']);
				})
				->pluck('slug');
		}

		if(count($this->filters['country']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('collection.brand.country', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['country']);
				})
				->pluck('slug');
		}

		// Case dimensions filters
		if(count($this->filters['case_diameter']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereIn('case->diameter', $this->filters['case_diameter'])
				->pluck('slug');
		}

		if(count($this->filters['case_lug_to_lug']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereIn('case->lug_to_lug', $this->filters['case_lug_to_lug'])
				->pluck('slug');
		}

		if(count($this->filters['case_lug_width']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereIn('case->lug_width', $this->filters['case_lug_width'])
				->pluck('slug');
		}

		if(count($this->filters['case_thickness']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereIn('case->thickness', $this->filters['case_thickness'])
				->pluck('slug');
		}

		// Case color, material and case back details filters
		if(count($this->filters['case_color']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('caseColors', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['case_color']);
				})
				->pluck('slug');
		}

		if(count($this->filters['case_material']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('caseMaterials', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['case_material']);
				})
				->pluck('slug');
		}

		if(!is_null($this->filters['case_open_case_back'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->where('case->open_case_back', (bool) $this->filters['case_open_case_back'])
				->pluck('slug');
		}

		if(!is_null($this->filters['case_sapphire_crystal_case_back'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->where('case->sapphire_crystal_case_back', (bool) $this->filters['case_sapphire_crystal_case_back'])
				->pluck('slug');
		}

		if(count($this->filters['case_waterproofness']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereIn('case->waterproofness', $this->filters['case_waterproofness'])
				->pluck('slug');
		}

		// Movement filters
		if(count($this->filters['movement_type']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('movement.movementType', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['movement_type']);
				})
				->pluck('slug');
		}

		if(!is_null($this->filters['movement_COSC'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('movement', function($whereHas) {
					$whereHas->where('COSC', (bool) $this->filters['movement_COSC']);
				})
				->pluck('slug');
		}

		if(!is_null($this->filters['movement_METAS'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('movement', function($whereHas) {
					$whereHas->where('METAS', (bool) $this->filters['movement_METAS']);
				})
				->pluck('slug');
		}

		if(!is_null($this->filters['movement_manufactured_caliber'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('movement', function($whereHas) {
					$whereHas->where('manufactured_caliber', (bool) $this->filters['movement_manufactured_caliber']);
				})
				->pluck('slug');
		}

		// specificities filters
		if(count($this->filters['power_reserve']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereIn('specificities->power_reserve', $this->filters['power_reserve'])
				->pluck('slug');
		}

		if(count($this->filters['complication']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('complications', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['complication']);
				})
				->pluck('slug');
		}

		// Bezel filters
		if(count($this->filters['bezel_direction']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereIn('bezel->direction', $this->filters['bezel_direction'])
				->pluck('slug');
		}

		if(count($this->filters['bezel_color']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('bezelColors', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bezel_color']);
				})
				->pluck('slug');
		}

		if(count($this->filters['bezel_marking']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('bezelMarkings', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bezel_marking']);
				})
				->pluck('slug');
		}

		if(count($this->filters['bezel_material']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('bezelMaterials', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bezel_material']);
				})
				->pluck('slug');
		}

		// Crystal filters
		if(!is_null($this->filters['crystal_domed'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->where('crystal->domed', (bool) $this->filters['crystal_domed'])
				->pluck('slug');
		}

		if(count($this->filters['crystal_material']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('crystalMaterials', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['crystal_material']);
				})
				->pluck('slug');
		}

		// Crown filters
		if(count($this->filters['crown_color']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('crownColors', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['crown_color']);
				})
				->pluck('slug');
		}

		if(count($this->filters['crown_material']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('crownMaterials', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['crown_material']);
				})
				->pluck('slug');
		}

		if(!is_null($this->filters['crown_screwed_down'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->where('crown->screwed_down', (bool) $this->filters['crown_screwed_down'])
				->pluck('slug');
		}

		// Dial filters
		if(count($this->filters['dial_color']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('dialColors', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['dial_color']);
				})
				->pluck('slug');
		}

		if(!is_null($this->filters['dial_domed'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->where('dial->domed', (bool) $this->filters['dial_domed'])
				->pluck('slug');
		}

		if(count($this->filters['dial_marker_color']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('dialMarkerColors', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['dial_marker_color']);
				})
				->pluck('slug');
		}

		if(!is_null($this->filters['dial_marker_lume'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->where('dial->marker_lume', (bool) $this->filters['dial_marker_lume'])
				->pluck('slug');
		}

		if(count($this->filters['dial_marker_lume_color']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('dialMarkerLumeColors', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['dial_marker_lume_color']);
				})
				->pluck('slug');
		}

		if(count($this->filters['dial_marker_type']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('dialMarkerTypes', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['dial_marker_type']);
				})
				->pluck('slug');
		}

		if(count($this->filters['dial_finish']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('dialFinishes', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['dial_finish']);
				})
				->pluck('slug');
		}

		// Bracelet filters
		if(count($this->filters['bracelet_type']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('braceletMaterials.braceletType', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bracelet_type']);
				})
				->pluck('slug');
		}

		if(count($this->filters['bracelet_material']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('braceletMaterials', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bracelet_material']);
				})
				->pluck('slug');
		}

		if(!is_null($this->filters['bracelet_micro_adjustement'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->where('bracelet->micro_adjustement', (bool) $this->filters['bracelet_micro_adjustement'])
				->pluck('slug');
		}

		if(count($this->filters['bracelet_micro_adjustement_system']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('braceletMicroAdjustementSystem', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bracelet_micro_adjustement_system']);
				})
				->pluck('slug');
		}

		if(!is_null($this->filters['bracelet_stitching'])) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->where('bracelet->stitching', (bool) $this->filters['bracelet_stitching'])
				->pluck('slug');
		}

		if(count($this->filters['bracelet_stitching_color']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('braceletStitchingColors', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bracelet_stitching_color']);
				})
				->pluck('slug');
		}

		if(count($this->filters['bracelet_color']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('braceletColor', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bracelet_color']);
				})
				->pluck('slug');
		}

		if(count($this->filters['bracelet_style']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('braceletStyle', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bracelet_style']);
				})
				->pluck('slug');
		}

		if(count($this->filters['bracelet_clasp']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('braceletClasp', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bracelet_clasp']);
				})
				->pluck('slug');
		}

		if(count($this->filters['bracelet_clasp_color']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('braceletClaspColors', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bracelet_clasp_color']);
				})
				->pluck('slug');
		}

		if(count($this->filters['bracelet_clasp_material']) > 0) {
			$this->watchSlugs = Watch::whereIn('slug', $this->watchSlugs)
				->whereHas('braceletClaspMaterials', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['bracelet_clasp_material']);
				})
				->pluck('slug');
		}

		return $this->watchSlugs;
	}

	private function watchesDataQuery()
	{
		return Watch::whereIn('slug', $this->filteredWatchSlugs());
	}

	private function loadModel($model, $watchSlugs, $hasToGoThrough = null)
	{
		return $model::whereHas(is_null($hasToGoThrough) ? 'watches' : $hasToGoThrough, function($whereHas) use($watchSlugs) {
				$whereHas->whereIn('watches.slug', $watchSlugs);
			})
			->orderBy('name')
			->pluck('name', 'slug');
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

	public function finderUpdated($changedField)
	{
		$fields = [
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
			'movement_type' => [
				'type' => 'entity',
				'model' => MovementType::class,
				'hasToGoThrough' => 'movements.watches'
			],
			'movement_COSC' => [
				'type' => 'json',
				'field' => 'movement.COSC',
				'boolean' => true,
			],
			'movement_METAS' => [
				'type' => 'json',
				'field' => 'movement.METAS',
				'boolean' => true,
			],
			'movement_manufactured_caliber' => [
				'type' => 'json',
				'field' => 'movement.manufactured_caliber',
				'boolean' => true,
			],
			'power_reserve' => [
				'type' => 'json',
				'field' => 'specificities.power_reserve'
			],
			'complication' => [
				'type' => 'entity',
				'model' => Complication::class
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
			'dial_finish' => [
				'type' => 'entity',
				'model' => DialFinish::class
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
			],
			'bracelet_material' => [
				'type' => 'entity',
				'model' => BraceletMaterial::class,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('bracelet', $this->filters['bracelet_type'])
			],
			'bracelet_micro_adjustement' => [
				'type' => 'json',
				'field' => 'bracelet.micro_adjustement',
				'boolean' => true,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('bracelet', $this->filters['bracelet_type'])
			],
			'bracelet_micro_adjustement_system' => [
				'type' => 'entity',
				'model' => BraceletMicroAdjustementSystem::class,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('bracelet', $this->filters['bracelet_type'])
			],
			'bracelet_stitching' => [
				'type' => 'json',
				'field' => 'bracelet.stitching',
				'boolean' => true,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('strap', $this->filters['bracelet_type'])
			],
			'bracelet_stitching_color' => [
				'type' => 'entity',
				'model' => BraceletStitchingColor::class,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('strap', $this->filters['bracelet_type'])
			],
			'bracelet_color' => [
				'type' => 'entity',
				'model' => BraceletColor::class
			],
			'bracelet_style' => [
				'type' => 'entity',
				'model' => BraceletStyle::class
			],
			'bracelet_clasp' => [
				'type' => 'entity',
				'model' => BraceletClasp::class
			],
			'bracelet_clasp_color' => [
				'type' => 'entity',
				'model' => BraceletClaspColor::class
			],
			'bracelet_clasp_material' => [
				'type' => 'entity',
				'model' => BraceletClaspMaterial::class
			],
		];

		$fieldKeys = array_keys($fields);

		if($changedField === 'type') {
			foreach($fieldKeys as $laterField) {
				$this->filters[$laterField] = is_array($this->filters[$laterField]) ? [] : null;
				unset($this->data[$laterField]);
			}
		}
		else {
			$index = array_search($changedField, $fieldKeys);

			if($index !== false) {
				foreach(array_slice($fieldKeys, $index + 1) as $laterField) {
					$this->filters[$laterField] = is_array($this->filters[$laterField]) ? [] : null;
					unset($this->data[$laterField]);
				}
			}
		}

		if(!empty($this->filters['type'])) {
			$watchesData = $this->watchesDataQuery()
				->get();

			foreach($fields as $field => $loader) {
				$value = $this->filters[$field] ?? null;
				$isEmpty = isset($loader['boolean']) ? is_null($value) : empty($value);

				if($isEmpty && (!isset($loader['condition']) || (isset($loader['condition']) && $loader['condition']))) {
					if($loader['type'] == 'entity') $data = $this->loadModel($loader['model'], $watchesData->pluck('slug'), isset($loader['hasToGoThrough']) ? $loader['hasToGoThrough'] : null);
					elseif($loader['type'] == 'json') $data = $this->loadJson($loader['field'], $watchesData, isset($loader['boolean']) ? $loader['boolean'] : false);

					$this->data[$field] = $data;

					if($data->count() === 0) continue;

					if($data->count() === 1) {
						if(isset($loader['boolean'])) $this->filters[$field] = $data->first();
						else $this->filters[$field] = $loader['type'] === 'entity' ? $data->keys()->toArray() : $data->toArray();
						continue;
					}

					break;
				}
			}
		}
	}

	public function experienceChosen()
	{
		session()->put('session', $this->session);
		$this->askExperience = false;
	}

	public function findMyWatch()
	{
		$this->showFoundWatch = true;
		$this->dispatch('watch-found');
	}

	public function showFinder()
	{
		$this->showFoundWatch = false;
		$this->dispatch('watch-finder');
	}

	public function mount()
	{
		$this->session['user_experience'] = null;
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
		$this->filters['crown_material'] = [];
		$this->filters['crown_screwed_down'] = null;

		// Crystal filters
		$this->filters['crystal_domed'] = null;
		$this->filters['crystal_material'] = [];

		// Dial filters
		$this->filters['dial_color'] = [];
		$this->filters['dial_domed'] = null;
		$this->filters['dial_finish'] = [];
		$this->filters['dial_marker_color'] = [];
		$this->filters['dial_marker_lume'] = null;
		$this->filters['dial_marker_lume_color'] = [];
		$this->filters['dial_marker_type'] = [];

		// Movement
		$this->filters['movement_type'] = [];
		$this->filters['movement_COSC'] = null;
		$this->filters['movement_METAS'] = null;
		$this->filters['movement_manufactured_caliber'] = null;

		$this->data['type'] = Type::select('name', 'slug')->orderBy('name', 'ASC')->get();

		if(Auth::guard('web')->check()) $this->session['user_experience'] = Auth::guard('web')->user()->experience->slug;

		if(session()->has('session')) {
			$sessions = session()->get('session');

			foreach($sessions as $key => $session) {
				if(!empty($sessions[$key])) $this->session[$key] = $sessions[$key];
			}
		}

		if(is_null($this->session['user_experience'])) {
			$this->askExperience = true;
			$this->data['experience'] = Experience::select('name', 'description', 'slug')->get();
		}

		$this->showFinder();
	}

	public function render()
	{
		return view('livewire.front.finder.index', [
			'watches' => $this->showFoundWatch ? $this->watchesDataQuery()->paginate(30) : collect([])
		]);
	}
}