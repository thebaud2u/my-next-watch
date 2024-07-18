<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;

use App\Models\Post;

class RecentlyPublished extends Component
{
	public function render()
	{
		$posts = Post::published()
			->latest()
			->limit(9)
			->get();

		return view('livewire.front.posts.recently-published', compact('posts'));
	}
}
