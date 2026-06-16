<?php

namespace App\Http\Livewire\Front\Comments;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Enums\CommentStates;

use App\Models\{Company, Comment, User};

class Comments extends Component
{
	// Entities
	public Company $company;
	public Comment $comment;
	public Comment $userComment;
	public User $user;

	// Properties
	public $create = false;
	public $update = false;
	public $inModal = false;
	public $case;
	public $source;
	public $target;
	public $comments;
	public $userCommentSet = false;

	// Misc
	public $commentComponentKey = 0;

	#[On('comment-validated')]
	public function commentValidated()
	{

	}

	#[On('comment-deleted')]
	public function commentDeleted()
	{

	}

	public function redirectToRegister()
	{
		session(['url.intended' => route('')]);

		return redirect()->to(route('login'));
	}

	public function mount()
	{

	}

	public function render()
	{
		switch($this->case) {
			default:
				$this->comment = new Comment;
				break;
		}

		$this->commentComponentKey++;

		return view('livewire.front.comments.comments');
	}
}
