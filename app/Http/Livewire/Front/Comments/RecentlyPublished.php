<?php

namespace App\Http\Livewire\Front\Comments;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Auth;

use App\Enums\{ModerationStates, CommentStates};

use App\Models\{Company, Moderation, Comment, CommentLike, User};

class RecentlyPublished extends Component
{
	public $countForSubComponent = 0;
	public $class;
	public $target;
	public $source;
	public $comments;
	public $countComments;
	public $withModeration = false;
	public $replyContent = null;
	public $isMyCompany = false;

	public $commentsWaitingModeration;

	#[On('comment-validated')]
	public function commentValidated()
	{
		$this->refreshComments();
	}

	public function moderate(Comment $comment)
	{
		$newModeration = new Moderation;
		$newModeration->model()->associate($comment);
		$newModeration->state = ModerationStates::Validated;
		$newModeration->save();
	}

	public function publishComment($id)
	{
		$comment = Comment::find($id);

		if($comment) {
			$comment->state = CommentStates::Published;
			$comment->save();

			$this->moderate($comment);
		}

		$this->refreshComments();
	}

	public function denyComment($id)
	{
		$comment = Comment::find($id);

		if($comment) {
			$comment->state = CommentStates::Denied;
			$comment->save();

			$this->moderate($comment);
		}

		$this->refreshComments();
	}

	public function like($commentId)
	{
		if($commentId && Auth::guard('web')->check()) {
			$commentToLike = Comment::find($commentId);

			if($commentToLike) {
				$hasAlreadyLiked = $commentToLike->likes()->whereHas('user', function($whereHas) {
						$whereHas->where('id', Auth::guard('web')->user()->id);
					})
					->first();

				if(!$hasAlreadyLiked) {
					$newLike = new CommentLike;
					$newLike->comment_id = $commentToLike->id;
					$newLike->user_id = Auth::guard('web')->user()->id;
					$newLike->save();
				}
				else $hasAlreadyLiked->delete();

				$this->refreshComments();
			}
		}
	}

	public function postReply($replyTo)
	{
		$rules = [
			'replyContent' => ['required']
		];

		$messages = [
			'replyContent.required' => __(':element is mandatory', ['element' => __('Your message')]),
		];

		$this->validate($rules, $messages);

		if($replyTo) {
			$commentToReplyTo = Comment::find($replyTo);

			if($commentToReplyTo) {
				$newReply = new Comment;
				$newReply->content = $this->replyContent;
				$newReply->state = CommentStates::WaitingModeration;
				$newReply->source()->associate(Auth::guard('web')->user());
				$newReply->target()->associate($commentToReplyTo);
				$newReply->save();

				$newReply->markForModeration();

				$this->replyContent = '';
				$this->dispatch('reply-posted');
				$this->refreshComments();
			}
		}
	}

	public function refreshComments()
	{
		$this->comments = $this->target
			->commentsReceived()
			->whereHasMorph('source', $this->class)
			->where('state', CommentStates::Published);

		$this->countComments = $this->comments->count();

		$this->comments = $this->comments->latest()
			->take(10)
			->get();

		$this->countForSubComponent++;

		if($this->withModeration) {
			$this->commentsWaitingModeration = $this->target
				->commentsReceived()
				->whereHasMorph('source', $this->class)
				->where('state', CommentStates::WaitingModeration)
				->latest()
				->get();
		}
	}

	public function mount()
	{
		if($this->source == 'company') $this->class = Company::class;
		elseif($this->source == 'reply') $this->class = User::class;

		$this->refreshComments();
	}

	public function render()
	{
		return view('livewire.front.comments.recently-published');
	}
}
