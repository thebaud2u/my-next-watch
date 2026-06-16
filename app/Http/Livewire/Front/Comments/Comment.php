<?php

namespace App\Http\Livewire\Front\Comments;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Enums\CommentStates;

use App\Models\{Company, Comment as ModelComment, User};

class Comment extends Component
{
	// Entities
	public $comment;

	// Properties
	public $target;
	public $source;
	public $case = null;
	public $create = false;
	public $update = false;
	public $inModal = false;
	public $contentLabel;
	public $content;
	public $componentGivenKey;

	protected function rules()
	{
		return [
			'content' => []
		];
	}

	public function submitCommentForm()
	{
		$rules = [
			'content' => ['required']
		];

		$messages = [
			'content.required' => __(':element is mandatory', ['element' => __('The description')]),
		];

		$this->validate($rules, $messages);

		$this->comment->content = $this->content;
		$this->comment->state = CommentStates::WaitingModeration;
		$this->comment->source()->associate($this->source);
		$this->comment->target()->associate($this->target);
		$this->comment->save();

		$this->comment->markForModeration();

		$this->dispatch('comment-validated');
		$this->dispatch('comment-form-done');
	}

	public function mount()
	{
		if($this->comment?->exists) $this->content = $this->comment->content;
		else $this->comment = new ModelComment;
	}

	public function render()
	{
		return view('livewire.front.comments.comment');
	}
}
