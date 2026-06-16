<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;

use App\Models\PostType;

class Cards extends Component
{
	public $filters;

	public function search($id)
	{
		$this->filters['post_type_id'] = $id;
		session()->put('filters', $this->filters);

		$postType = PostType::find($id);

		return redirect()->route('posts', ['postType' => $postType]);
	}

	public function render()
	{
		return view('livewire.front.posts.cards');
	}
}
