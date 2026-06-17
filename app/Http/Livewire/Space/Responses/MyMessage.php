<?php

namespace App\Http\Livewire\Front\Space\Responses;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Cmgmyr\Messenger\Models\{Participant, Thread};

use App\Enums\{PublicationStates, ResponseStates};

use App\Models\{Company, Message, Post, Response, User};

class MyMessage extends Component
{
	use WithFileUploads;

	// Entities
	public Response $response;
	public $model;

	// Collections
	public $messages;

	// Properties
	public $applications = false;
	public $applicants = false;
	public $fromUser;
	public $toUser;
	public $photoLeft;
	public $photoRight;
	public $name;
	public $type;
	public $goToRoute;
	public $situation;
	public $showAutomaticMessageTemplatesModal = false;
	public $showCommentModal = false;
	public $templatesSelected = [];

	// Inputs
	public $newMessage;
	public $file;

	protected function rules()
	{
		return [
			'newMessage' => [],
			'file' => []
		];
	}

	#[On('clear')]
	public function clear()
	{
		$this->response = new Response;
	}

	#[On('last-step-modal')]
	public function lastStepModal()
	{
		if($this->situation == 'answerer') $this->showAutomaticMessageTemplatesModal = true;
		elseif($this->situation == 'asking') $this->showCommentModal = true;
	}

	#[On('show')]
	public function show($id)
	{
		if($id) {
			if(!$this->response->exists || $this->response->id != $id) {
				$response = Response::find($id);

				if($response) $this->response = $response;
			}

			$this->initProperties();
			$this->refreshConversation();
		}
	}

	public function archiveConversation()
	{
		$partArchive = collect($this->response->values->get('archive'));

		if($this->situation == 'asking') $partArchive->put('asking', true);
		elseif($this->situation == 'answerer') $partArchive->put('answerer', true);

		$this->response->updateValue('archive', $partArchive);
		$this->response->saveQuietly();

		$this->dispatch('conversation-archived');
		$this->dispatch('refresh-list');
	}

	public function archivePost()
	{
		$post = $this->response->model;
		$post->archived_at = Carbon::now();
		$post->save();

		$lastPublication = $post->lastPublication;
		$post->publications()->create([
			'user_id' => $post->user->id,
			'subscription_id' => $lastPublication->subscription->id,
			'state' => PublicationStates::Archived,
			'end_date' => $lastPublication->subscription->end_date
		]);
	}

	public function refreshConversation()
	{
		$this->messages = $this->response->getMessages();

		foreach($this->messages as $message) {
			if($message->user?->id != Auth::guard('web')->user()->id) $message->markAsRead();
		}
	}

	public function initProperties()
	{
		$this->response->refresh();
		$this->goToRoute = null;

		if(Auth::guard('web')->user()->id == $this->response->from->id) {
			$this->situation = 'asking';
			$this->fromUser = $this->response->from;
			$this->toUser = $this->response->to;
		}
		else {
			$this->situation = 'answerer';
			$this->fromUser = $this->response->to;
			$this->toUser = $this->response->from;
		}

		$this->model = $this->response->model;
		$this->messages = $this->response->getMessages();

		if($this->model instanceof Company) {
			$this->type = 'company';

			if($this->model->isPublished())	$this->goToRoute = route('company-search.company.show', ['company' => $this->model->slug]);

			if($this->situation == 'asking') {
				$this->photoLeft = $this->toUser->getFirstMedia('avatar');
				$this->photoRight = $this->model->getFirstMedia('logo');
				if(!$this->photoRight) $this->photoRight = $this->model->getFirstMedia('photos');

				$this->name = $this->model->name;
			}
			elseif($this->situation == 'answerer') {
				if($this->toUser->hasRole('recruiter') && $this->toUser->company) {
					$this->photoLeft = $this->toUser->getFirstMedia('avatar');
					$this->photoRight = $this->model->getFirstMedia('logo');
					if(!$this->photoRight) $this->photoRight = $this->model->getFirstMedia('photos');

					$this->name = $this->toUser->company->name;
				}
				else {
					$this->photoLeft = $this->toUser->getFirstMedia('avatar');
					$this->photoRight = $this->model->getFirstMedia('logo');
					if(!$this->photoRight) $this->photoRight = $this->model->getFirstMedia('photos');
					$this->name = $this->toUser->name;
				}
			}
		}
		elseif($this->model instanceof Post) {
			$this->type = 'post';

			if($this->model->isPublished())	$this->goToRoute = route('post-search.post.show', ['company' => $this->model->model->company->slug, 'post' => $this->model->slug]);

			$this->photoRight = $this->model->getFirstMedia('photos'.$this->model->id);

			if($this->situation == 'asking') {
				$this->photoLeft = $this->toUser->getFirstMedia('avatar');
				$this->name = $this->model->model->company->name;
			}
			elseif($this->situation == 'answerer') {
				$this->photoLeft = $this->toUser->getFirstMedia('avatar');

				if($this->toUser->hasRole('recruiter') && $this->toUser->company) $this->name = $this->toUser->company->name;
				else $this->name = $this->toUser->name;
			}
		}
		else $this->name = $this->toUser->name;
	}

	public function send()
	{
		$rules = [
			'newMessage' => ['required_without_all:file', 'nullable', 'string'],
			'file' => ['required_without_all:newMessage', 'nullable', 'file', 'mimes:pdf,jpg,png', 'max:12288'],
		];

		$messages = [
			'newMessage.required_without_all' => __(':element is mandatory', ['element' => __('Your message')]),
			'file.required_without_all' => __(':element is mandatory', ['element' => __('A file')]),
			'file.file' => __(':element is expected', ['element' => __('A file')]),
			'file.mimes' => __(':element of the following format is expected : :format', ['element' => __('A file'), 'format' => 'pdf, jpg, png']),
			'file.max' => __(':size maximum', ['size' => '12mo'])
		];

		$this->validate($rules, $messages);

		$path = null;
		if($this->file) $path = $this->file->store('messages', 'private');

		$message = Message::create([
			'thread_id' => $this->response->thread->id,
			'user_id' => Auth::guard('web')->user()->id,
			'body' => $this->newMessage,
			'file' => $path,
			'is_read' => false
		]);

		$this->response->load('thread');
		$partArchive = collect($this->response->values->get('archive'));

		$partArchive->put('asking', false);
		$partArchive->put('answerer', false);

		$this->response->updateValue('archive', $partArchive);
		$this->response->saveQuietly();

		$this->refreshConversation();

		$this->newMessage = '';
		$this->file = '';
	}

	public function mount()
	{
		if($this->response->id) $this->initProperties();
		else $this->response = new Response;

		$this->applications = Auth::guard('web')->user()->applications()->exists();
		$this->applicants = Auth::guard('web')->user()->applicants()->exists();
	}

	public function render()
	{
		return view('livewire.front.space.responses.my-message');
	}
}
