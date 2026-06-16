<?php

namespace App\Http\Livewire\Front\Companies;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Enums\PostTypesAvailable;

use App\Models\PostType;

class AdvancedFilters extends Component
{

	public $filters;
	public $responsive = false;

	// Filters fields
	public $postsTypesAvailable;

	public function search()
	{
		$this->dispatch('companies-advanced-filters', filters: $this->filters);
	}

	public function resetForm()
	{
		$this->filters['company_post_type_available'] = [];
		$this->filters['company_order_by'] = 'revelancy';

		$this->dispatch('form-reset');
		$this->search();
	}

	public function mount()
	{
		$this->filters['company_post_type_available'] = [];
		$this->filters['company_order_by'] = 'revelancy';

		$this->postsTypesAvailable = PostTypesAvailable::asHumanArray();
	}

	public function render()
	{
		return view('livewire.front.companies.advanced-filters');
	}
}
