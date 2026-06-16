<?php

namespace App\Http\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\WithPagination;

use App\Enums\{PublicationStates};

use App\Models\{Animal, Offer, Post, PostType, User};

class Posts extends Component
{
	use WithPagination;

	// Filters
	public $keyword;
	public $postType;
	public $postTypesList;
	public $offer;
	public $offersList;
	public $state;
	public $statesList;
	public $user;
	public $usersList;

	// Properties
	public Post $post;

	public $currentExpirationDate;
	public $newExpirationDate;

	protected function rules() {
		return [
			'newExpirationDate' => [],
		];
	}

	public function fresh()
	{
		$this->post = new Post;

		$this->dispatch('post-reset');
	}

	public function getPost($id)
	{
		$this->fresh();

		$this->post = Post::find($id);

		$lastPublication = $this->post->lastPublication;

		$this->currentExpirationDate = $lastPublication->end_date->format('d/m/Y');

		$this->dispatch('post-loaded');
	}

	public function setPost()
	{
		/*$rules = [

		];

		$messages = [

		];

		$this->validate($rules, $messages);*/



		$this->dispatch('post-validated');

		$this->fresh();
	}

	public function setExpirationDate()
	{
		$rules = [
			'newExpirationDate' => ['required'],
		];

		$messages = [
			'newExpirationDate.required' => __(':element is mandatory', ['element' => __('The new date of expiration')])
		];

		$this->validate($rules, $messages);

		$lastPublication = $this->post->lastPublication;

		if($lastPublication) {
			$lastPublication->end_date = $this->newExpirationDate;
			$lastPublication->save();
		}

		$this->post->archived_at = $this->newExpirationDate;
		$this->post->save();

		$this->dispatch('post-validated');

		$this->fresh();
	}

	public function setPureBreed($id)
	{
		$post = Post::find($id);

		if($post) {
			if($post->model->values->has('pure_breed')) {
				$post->model->updateValue('pure_breed', true);
				$post->model->save();
			}

			$children = $post->model->animals;

			if($children->isNotEmpty()) {
				foreach($children as $child) {
					$child->updateValue('pure_breed', true);
					$child->save();
				}
			}
		}
	}

	public function mount()
	{
		$this->fresh();

		$this->postTypesList = PostType::all();
		$this->offersList = Offer::where('type', 'post')
			->get();
		$this->statesList = PublicationStates::asHumanArray();

		$this->usersList = User::whereHas('roles', function($whereHas) {
				$whereHas->whereIn('name', ['breeder', 'individual_breeder', 'professionnal_breeder']);
			})
			->orderBy('lastname', 'ASC')
			->orderBy('firstname', 'ASC')
			->get();
	}

	public function render()
	{
		$posts = Post::when($this->user, function($when) {
				$when->whereHas('user', function($whereHas) {
					$whereHas->where('slug', $this->user);
				});
			})
			->when($this->keyword, function($when) {
				$when->where(function($where) {
					$where->whereHas('user', function($whereHas) {
						$whereHas->where('lastname', 'LIKE', '%'.$this->keyword.'%')
							->orWhere('firstname', 'LIKE', '%'.$this->keyword.'%')
							->orWhere('email', 'LIKE', '%'.$this->keyword.'%');
					});
				})
				->orWhere('name', 'LIKE', '%'.$this->keyword.'%')
				->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
				->orWhere('id', 'LIKE', '%'.$this->keyword.'%')
				->orWhereHasMorph('model', [Animal::class], function($whereHasMorph) {
					$whereHasMorph->where('name', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('description', 'LIKE', '%'.$this->keyword.'%');
				});
			})
			->when($this->postType, function($when) {
				$when->whereHas('type', function($whereHas) {
					$whereHas->where('id', $this->postType);
				});
			})
			->when($this->state, function($when) {
				$when->whereHas('lastPublication', function($whereHas) {
					$whereHas->where('state', $this->state);
				});
			})
			->when($this->offer, function($when) {
				$when->whereHas('lastPublication', function($whereHas) {
					$whereHas->whereHas('subscription', function($whereHasSubscription) {
						$whereHasSubscription->whereHas('offer', function($whereHasOffer) {
							$whereHasOffer->where('slug', $this->offer);
						});
					});
				});
			})
			->whereHas('user')
			->latest('published_at')
			->paginate(10);

		return view('livewire.admin.posts.posts', [
			'posts' => $posts
		]);
	}
}
