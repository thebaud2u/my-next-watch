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
	public $step = 'generalities';
	public $filters = [];
	public $data = [];

	public function navigate()
	{
		switch($this->step) {
			case 'generalities':
				$this->data['types'] = Type::orderBy('name', 'ASC')->get();
				$this->data['countries'] = Country::whereIn('code', ['FRA', 'USA', 'CHE', 'JPN', 'GBR'])->get();
				break;

			case 'dimensions':
				# code...
				break;
			
			case 'price':
				# code...
				break;
		}
	}

	public function mount()
	{
		$this->filters['keyword'] = null;
		$this->filters['country'] = [];
		$this->filters['type'] = [];
		$this->filters['min_price'] = null;
		$this->filters['max_price'] = null;
		$this->filters['complication'] = [];
		$this->filters['min_power_reserve'] = null;
		$this->filters['max_power_reserve'] = null;

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
		$this->filters['min_case_diameter'] = null;
		$this->filters['max_case_diameter'] = null;
		$this->filters['min_case_lug_to_lug'] = null;
		$this->filters['max_case_lug_to_lug'] = null;
		$this->filters['min_case_lug_width'] = null;
		$this->filters['max_case_lug_width'] = null;
		$this->filters['case_material'] = [];
		$this->filters['case_open_case_back'] = [];
		$this->filters['case_sapphire_crystal_case_back'] =[];
		$this->filters['min_case_thickness'] = null;
		$this->filters['max_case_thickness'] = null;
		$this->filters['case_waterproofness'] = null;
		
		// Crown filters
		$this->filters['crown_color'] = [];
		$this->filters['crown_detail'] = [];
		$this->filters['crown_material'] = [];
		$this->filters['crown_screwed_down'] = null;
		
		// Crystal filters
		$this->filters['crystal_domed'] = null;
		$this->filters['crystal_material'] = null;

		// Dial filters
		$this->filters['dial_color'] = [];
		$this->filters['dial_domed'] = [];
		$this->filters['dial_marker_color'] = [];
		$this->filters['dial_marker_lume'] = [];
		$this->filters['dial_marker_lume_color'] = [];
		$this->filters['dial_marker_type'] = [];
		$this->filters['dial_textured'] = null;

		if(session()->has('filters')) {
			$sessionFilters = session()->get('filters');

			foreach($sessionFilters as $key => $filter) {
				if(!empty($sessionFilters[$key])) $this->filters[$key] = $sessionFilters[$key];
			}
		}

		$this->navigate();
	}

	public function render()
	{
		return view('livewire.front.finder.filters');
	}
}
