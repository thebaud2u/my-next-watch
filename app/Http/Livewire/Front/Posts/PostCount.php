<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;
use Livewire\Attributes\On;

class PostCount extends Component
{
	public $postCount;

	#[On('set-post-count')]
	public function setPostCount($postCount)
	{
        $this->postCount = $postCount;
	}

	public function render()
	{
		return view('livewire.front.posts.post-count');
	}
}
