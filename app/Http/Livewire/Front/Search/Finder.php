<?php

namespace App\Http\Livewire\Front\Search;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use App\Models\Watch;

class Finder extends Component
{
	use WithPagination;

	public $filters;

	#[On('filters-update')]
	public function filtersUpdate(array $filters)
	{
		$this->filters['keyword'] = $filters['keyword'];
		$this->filters['country_id'] = $filters['country_id'];
		$this->filters['min_price'] = $filters['min_price'];
		$this->filters['max_price'] = $filters['max_price'];
		$this->filters['complication'] = $filters['complication'];
		$this->filters['min_power_reserve'] = $filters['min_power_reserve'];
		$this->filters['max_power_reserve'] = $filters['powemax_r_reserve'];

		// Bezel filters
		$this->filters['bezel_color'] = $filters['bezel_color'];
		$this->filters['bezel_direction'] = $filters['bezel_direction'];
		$this->filters['bezel_marking'] = $filters['bezel_marking'];
		$this->filters['bezel_material'] = $filters['bezel_material'];
		
		// Bracelet filters
		$this->filters['bracelet_clasp'] = $filters['bracelet_clasp'];
		$this->filters['bracelet_clasp_color'] = $filters['bracelet_clasp_color'];
		$this->filters['bracelet_clasp_material'] = $filters['bracelet_clasp_material'];
		$this->filters['bracelet_material'] = $filters['bracelet_material'];
		$this->filters['bracelet_micro_adjustement'] = $filters['bracelet_micro_adjustement'];
		$this->filters['bracelet_micro_adjustement_system'] = $filters['bracelet_micro_adjustement_system'];
		$this->filters['bracelet_stitching'] = $filters['bracelet_stitching'];
		$this->filters['bracelet_stitching_color'] = $filters['bracelet_stitching_color'];
		$this->filters['bracelet_style'] = $filters['bracelet_style'];
		
		// Case filters
		$this->filters['case_color'] = $filters['case_color'];
		$this->filters['min_case_diameter'] = $filters['case_diameter'];
		$this->filters['max_case_diameter'] = $filters['case_diameter'];
		$this->filters['min_case_lug_to_lug'] = $filters['case_lug_to_lug'];
		$this->filters['max_case_lug_to_lug'] = $filters['case_lug_to_lug'];
		$this->filters['min_case_lug_width'] = $filters['case_lug_width'];
		$this->filters['max_case_lug_width'] = $filters['case_lug_width'];
		$this->filters['case_material'] = $filters['case_material'];
		$this->filters['case_open_case_back'] = $filters['case_open_case_back'];
		$this->filters['case_sapphire_crystal_case_back'] = $filters['case_sapphire_crystal_case_back'];
		$this->filters['min_case_thickness'] = $filters['case_thickness'];
		$this->filters['max_case_thickness'] = $filters['case_thickness'];
		$this->filters['case_waterproofness'] = $filters['case_waterproofness'];
		
		// Crown filters
		$this->filters['crown_color'] = $filters['crown_color'];
		$this->filters['crown_detail'] = $filters['crown_detail'];
		$this->filters['crown_material'] = $filters['crown_material'];
		$this->filters['crown_screwed_down'] = $filters['crown_screwed_down'];
		
		// Crystal filters
		$this->filters['crystal_domed'] = $filters['crystal_domed'];
		$this->filters['crystal_material'] = $filters['crystal_material'];

		// Dial filters
		$this->filters['dial_color'] = $filters['dial_color'];
		$this->filters['dial_domed'] = $filters['dial_domed'];
		$this->filters['dial_marker_color'] = $filters['dial_marker_color'];
		$this->filters['dial_marker_lume'] = $filters['dial_marker_lume'];
		$this->filters['dial_marker_lume_color'] = $filters['dial_marker_lume_color'];
		$this->filters['dial_marker_type'] = $filters['dial_marker_type'];
		$this->filters['dial_textured'] = $filters['dial_textured'];
	}

	#[On('order-by-update')]
	public function orderByUpdate($filters)
	{
		$this->filters['order_by'] = $filters['order_by'];
	}

	public function mount()
	{
		// Search filters
		$this->filters['keyword'] = null;

		$this->filters['country_id'] = null;

		// Advanced search filters
		$this->filters['order_by'] = 'revelancy';

		if(session()->has('filters')) {
			$filters = session()->get('filters');

			if(!empty($filters['keyword'])) $this->filters['keyword'] = $filters['keyword'];
			if(!empty($filters['country_id'])) $this->filters['country_id'] = $filters['country_id'];
		}
	}

	public function render()
	{
		return view('livewire.front.search.finder');
	}
}
