<?php

namespace App\Http\Livewire\Front\Space\Responses;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Auth;

use App\Models\{Company, Response, Post};

class MyMessages extends Component
{
	public Response $activeResponse;

	public $responses;
	public $applications;
	public $applicants;

	public $filters;

	#[On('filters')]
	public function filters(array $filters)
	{
		$this->filters['type'] = $filters['type'];
		$this->filters['not-read-only'] = $filters['not-read-only'];

		$this->initResponses();
	}

	#[On('refresh-list')]
	public function refreshList($lastStepCallback = false, $response = null)
	{
		if(is_null($response)) $this->activeResponse = new Response;

		$this->initResponses($lastStepCallback);
	}

	public function sendFirstResponse($lastStepCallback = false)
	{
		if($this->responses->isNotEmpty()) {
			if($this->activeResponse->exists) $this->show($this->activeResponse->id, $lastStepCallback);
			else $this->show($this->responses->first()->id, $lastStepCallback);
		}
		else $this->dispatch('clear');
	}

	public function show($id, $lastStepCallback = false)
	{
		$this->activeResponse = Response::find($id);
		$this->activeResponse->thread->markAsRead(Auth::guard('web')->user()->id);
		$this->dispatch('show', $id);

		if($lastStepCallback) $this->dispatch('last-step-modal');
	}

	public function initResponses($lastStepCallback = false)
	{
		$this->applicants = Auth::guard('web')->user()
			->applicants()
			->when($this->filters['type'], function($when) {
				if($this->filters['type'] == 'archived') $when->where('responses.values->archive->answerer', true);
			})
			->when($this->filters['not-read-only'], function($when) {
				$when->withCount([
					'thread as unread_messages_count' => function($withCount) {
						$withCount->whereHas('messages', function($whereHas) {
							$whereHas->where('is_read', 0)
								->where('user_id', '!=', Auth::guard('web')->user()->id);
						});
					}
				])->having('unread_messages_count', '>', 0);
			})
			->get();

		$this->applications = Auth::guard('web')->user()
			->applications()
			->when($this->filters['type'], function($when) {
				if($this->filters['type'] == 'archived') $when->where('responses.values->archive->asking', true);
			})
			->when($this->filters['not-read-only'], function($when) {
				$when->withCount([
					'thread as unread_messages_count' => function($withCount) {
						$withCount->whereHas('messages', function($whereHas) {
							$whereHas->where('is_read', 0)
								->where('user_id', '!=', Auth::guard('web')->user()->id);
						});
					}
				])->having('unread_messages_count', '>', 0);
			})
			->get();

		$this->responses = $this->applications->merge($this->applicants)
			->sortByDesc('updated_at')
			->values();

		if($lastStepCallback) $this->sendFirstResponse(true);
	}

	public function mount()
	{
		$this->filters['type'] = null;
		$this->filters['not-read-only'] = false;

		$this->initResponses();
	}

	public function render()
	{
		return view('livewire.front.space.responses.my-messages');
	}
}