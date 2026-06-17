<?php

namespace App\Http\Livewire\Front\Space\Responses;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Enums\ResponseStates;

use App\Models\{Response, Post};

class Filters extends Component
{
	public $type;
	public $filters;

	public $types = [];

	public function search()
	{
		$this->dispatch('filters', $this->filters);
	}

	public function mount()
	{
		$this->filters['type'] = null;
		$this->filters['not-read-only'] = false;

		$postResponsesApplicant = Auth::guard('web')->user()->applicants()
			->get();

		$postResponsesApplications = Auth::guard('web')->user()->applications()
			->get();

		$hasPostResponses = $postResponsesApplicant->merge($postResponsesApplications);

		if($hasPostResponses->isNotEmpty()) $this->types[] = ['value' => 'posts', 'label' => __('Posts messages')];

		$applicantsArchived = Auth::guard('web')->user()
			->applicants()
			->where('values->archive->answerer', true)
			->get();

		$applicationsArchived = Auth::guard('web')->user()
			->applications()
			->where('values->archive->asking', true)
			->get();

		$hasArchivedResponses = $applicantsArchived->merge($applicationsArchived);

		if($hasArchivedResponses->isNotEmpty()) $this->types[] = ['value' => 'archived', 'label' => __('Archived messages')];

		$this->dispatch('reponses-show-ready');
	}

	public function render()
	{
		return view('livewire.front.space.responses.filters');
	}
}
