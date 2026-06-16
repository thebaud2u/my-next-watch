<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Breed;
use App\Models\PostType;
use App\Models\Species;

class PostCount extends Component
{
	public $postCount;
	public Breed $breed;
	public PostType $postType;
	public Species $species;

	#[On('set-post-count')]
	public function setPostCount($postCount)
	{
		$this->postCount = $postCount;
	}

	public function mount()
	{
		if($this->breed->exists && $this->breed->species->getTranslation('slug', 'en') != $this->species->getTranslation('slug', 'en')) {
			$this->breed = new Breed;
		}
	}

	public function render()
	{
		return view('livewire.front.posts.post-count');
	}
}
