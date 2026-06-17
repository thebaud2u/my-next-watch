<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;

use Auth;

class RecentlyViewed extends Component
{
	public function render()
	{
		$posts = Auth::guard('web')->user()->recentlyViewedPosts();

		return view('livewire.front.posts.recently-viewed', compact('posts'));
	}
}
