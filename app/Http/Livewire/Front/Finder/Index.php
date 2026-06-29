<?php

namespace App\Http\Livewire\Front\Finder;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\{Brand, Collection, Country, Movement, Type, Watch};
use App\Models\WatchDetails\ {
	BezelColor, BezelMarking, BezelMaterial, BraceletClasp, BraceletClaspColor, BraceletClaspMaterial, BraceletColor, BraceletMaterial,
	BraceletMicroAdjustementSystem, BraceletStitchingColor, BraceletStyle, BraceletType,
	CaseColor, CaseMaterial, Complication, CrownColor, CrownMaterial, CrystalMaterial,
	DialColor, DialMarkerColor, DialMarkerLumeColor, DialMarkerType
};

class Index extends Component
{
	use WithPagination;

	public $showFoundWatch = false;
	public $filters = [];
	public $data = [];

	/**
	 * Build the restricted list of matching watch IDs by applying each active
	 * filter one at a time on top of the previous result, instead of stacking
	 * every predicate into a single query. Each step only ever asks MySQL to
	 * evaluate one condition against an already-reduced set of IDs, which keeps
	 * every query trivial regardless of how many filters are active at once.
	 */
	private function filteredWatchIds()
	{
		$watchIds = Watch::query()->pluck('id');

		// Generalities filters
		if (count($this->filters['type']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('types', function($whereHas) {
					$whereHas->whereIn('slug', $this->filters['type']);
				})
				->pluck('id');
		}

		if (count($this->filters['country']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('collection.brand.country', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['country']);
				})
				->pluck('id');
		}

		// Case dimensions filters
		if (count($this->filters['case_diameter']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereIn('case->diameter', $this->filters['case_diameter'])
				->pluck('id');
		}

		if (count($this->filters['case_lug_to_lug']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereIn('case->lug_to_lug', $this->filters['case_lug_to_lug'])
				->pluck('id');
		}

		if (count($this->filters['case_lug_width']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereIn('case->lug_width', $this->filters['case_lug_width'])
				->pluck('id');
		}

		if (count($this->filters['case_thickness']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereIn('case->thickness', $this->filters['case_thickness'])
				->pluck('id');
		}

		// Case color, material and case back details filters
		if (count($this->filters['case_color']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('caseColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['case_color']);
				})
				->pluck('id');
		}

		if (count($this->filters['case_material']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('caseMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['case_material']);
				})
				->pluck('id');
		}

		if (!is_null($this->filters['case_open_case_back'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('case->open_case_back', (bool) $this->filters['case_open_case_back'])
				->pluck('id');
		}

		if (!is_null($this->filters['case_sapphire_crystal_case_back'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('case->sapphire_crystal_case_back', (bool) $this->filters['case_sapphire_crystal_case_back'])
				->pluck('id');
		}

		if (count($this->filters['case_waterproofness']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereIn('case->waterproofness', $this->filters['case_waterproofness'])
				->pluck('id');
		}

		// Bezel filters
		if (count($this->filters['bezel_color']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('bezelColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bezel_color']);
				})
				->pluck('id');
		}

		if (count($this->filters['bezel_direction']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereIn('bezel->direction', $this->filters['bezel_direction'])
				->pluck('id');
		}

		if (count($this->filters['bezel_marking']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('bezelMarkings', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bezel_marking']);
				})
				->pluck('id');
		}

		if (count($this->filters['bezel_material']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('bezelMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bezel_material']);
				})
				->pluck('id');
		}

		// Crystal filters
		if (!is_null($this->filters['crystal_domed'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('crystal->domed', (bool) $this->filters['crystal_domed'])
				->pluck('id');
		}

		if (count($this->filters['crystal_material']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('crystalMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['crystal_material']);
				})
				->pluck('id');
		}

		// Crown filters
		if (count($this->filters['crown_color']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('crownColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['crown_color']);
				})
				->pluck('id');
		}

		if (count($this->filters['crown_detail']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('crown->detail', $this->filters['crown_detail'])
				->pluck('id');
		}

		if (count($this->filters['crown_material']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('crownMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['crown_material']);
				})
				->pluck('id');
		}

		if (!is_null($this->filters['crown_screwed_down'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('crown->screwed_down', (bool) $this->filters['crown_screwed_down'])
				->pluck('id');
		}

		// Dial filters
		if (count($this->filters['dial_color']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('dialColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_color']);
				})
				->pluck('id');
		}

		if (!is_null($this->filters['dial_domed'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('dial->domed', (bool) $this->filters['dial_domed'])
				->pluck('id');
		}

		if (count($this->filters['dial_marker_color']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('dialMarkerColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_marker_color']);
				})
				->pluck('id');
		}

		if (!is_null($this->filters['dial_marker_lume'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('dial->marker_lume', (bool) $this->filters['dial_marker_lume'])
				->pluck('id');
		}

		if (count($this->filters['dial_marker_lume_color']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('dialMarkerLumeColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_marker_lume_color']);
				})
				->pluck('id');
		}

		if (count($this->filters['dial_marker_type']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('dialMarkerTypes', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['dial_marker_type']);
				})
				->pluck('id');
		}

		if (!is_null($this->filters['dial_skeleton'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('dial->skeleton', (bool) $this->filters['dial_skeleton'])
				->pluck('id');
		}

		if (!is_null($this->filters['dial_textured'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('dial->textured', (bool) $this->filters['dial_textured'])
				->pluck('id');
		}

		// Bracelet filters
		if (count($this->filters['bracelet_type']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('braceletMaterials.braceletType', function($whereHas) {
					$whereHas->whereIn('bracelet_types.id', $this->filters['bracelet_type']);
				})
				->pluck('id');
		}

		if (count($this->filters['bracelet_material']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('braceletMaterials', function($whereHas) {
					$whereHas->whereIn('bracelet_materials.id', $this->filters['bracelet_material']);
				})
				->pluck('id');
		}

		if (!is_null($this->filters['bracelet_micro_adjustement'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('bracelet->micro_adjustement', (bool) $this->filters['bracelet_micro_adjustement'])
				->pluck('id');
		}

		if (count($this->filters['bracelet_micro_adjustement_system']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('braceletMicroAdjustementSystem', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_micro_adjustement_system']);
				})
				->pluck('id');
		}

		if (!is_null($this->filters['bracelet_stitching'])) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->where('bracelet->stitching', (bool) $this->filters['bracelet_stitching'])
				->pluck('id');
		}

		if (count($this->filters['bracelet_stitching_color']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('braceletStitchingColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_stitching_color']);
				})
				->pluck('id');
		}

		if (count($this->filters['bracelet_color']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('braceletColor', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_color']);
				})
				->pluck('id');
		}

		if (count($this->filters['bracelet_style']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('braceletStyle', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_style']);
				})
				->pluck('id');
		}

		if (count($this->filters['bracelet_clasp']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('braceletClasp', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_clasp']);
				})
				->pluck('id');
		}

		if (count($this->filters['bracelet_clasp_color']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('braceletClaspColors', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_clasp_color']);
				})
				->pluck('id');
		}

		if (count($this->filters['bracelet_clasp_material']) > 0) {
			$watchIds = Watch::whereIn('id', $watchIds)
				->whereHas('braceletClaspMaterials', function($whereHas) {
					$whereHas->whereIn('id', $this->filters['bracelet_clasp_material']);
				})
				->pluck('id');
		}

		return $watchIds;
	}

	/**
	 * Returns a Watch query builder restricted to the IDs computed by
	 * filteredWatchIds(). Kept as a thin wrapper so the rest of the file
	 * (which calls ->get() on this) doesn't need to change.
	 */
	private function watchesDataQuery()
	{
		return Watch::whereIn('id', $this->filteredWatchIds());
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

	public function finderUpdated($changedField = null)
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
			],
			'bracelet_material' => [
				'type' => 'entity',
				'model' => BraceletMaterial::class,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('1', $this->filters['bracelet_type'])
			],
			'bracelet_micro_adjustement' => [
				'type' => 'json',
				'field' => 'bracelet.micro_adjustement',
				'boolean' => true,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('1', $this->filters['bracelet_type'])
			],
			'bracelet_micro_adjustement_system' => [
				'type' => 'entity',
				'model' => BraceletMicroAdjustementSystem::class,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('1', $this->filters['bracelet_type'])
			],
			'bracelet_stitching' => [
				'type' => 'json',
				'field' => 'bracelet.stitching',
				'boolean' => true,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('2', $this->filters['bracelet_type'])
			],
			'bracelet_stitching_color' => [
				'type' => 'entity',
				'model' => BraceletStitchingColor::class,
				'condition' => count($this->filters['bracelet_type']) > 0 && in_array('2', $this->filters['bracelet_type'])
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

		if($changedField !== null) {
			$index = array_search($changedField, $fieldKeys);

			foreach(array_slice($fieldKeys, $index + 1) as $laterField) {
				$this->filters[$laterField] = is_array($this->filters[$laterField]) ? [] : null;
			}
		}

		$watchesData = $this->watchesDataQuery()
			->get();

		foreach($fields as $field => $loader) {
			$value = $this->filters[$field] ?? null;
			$isEmpty = isset($loader['boolean']) ? is_null($value) : empty($value);

			if($isEmpty && (!isset($loader['condition']) || (isset($loader['condition']) && $loader['condition']))) {
				if($loader['type'] == 'entity') $data = $this->loadModel($loader['model'], $watchesData->pluck('id'), isset($loader['hasToGoThrough']) ? $loader['hasToGoThrough'] : null);
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

	public function findMyWatch()
	{
		$this->showFoundWatch = true;
	}

	public function showFinder()
	{
		$this->showFoundWatch = false;
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
		return view('livewire.front.finder.index', [
			'watches' => $this->showFoundWatch ? $this->watchesDataQuery()->paginate(30) : collect([])
		]);
	}
}