<?php

namespace App\Http\Livewire\Front\Companies;

use Livewire\Component;
use Livewire\Attributes\On;

class CompanyCount extends Component
{
	public $companyCount;

	#[On('set-company-count')]
	public function setCompanyCount($companyCount)
	{
		$this->companyCount = $companyCount;
	}

	public function mount()
	{

	}

	public function render()
	{
		return view('livewire.front.companies.company-count');
	}
}
