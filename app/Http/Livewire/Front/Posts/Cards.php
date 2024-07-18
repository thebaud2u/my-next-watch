<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;

use App\Models\PostType;
use App\Models\Thematic;

class Cards extends Component
{
	public $filters;
	public Thematic $thematic;

	public function search($id)
	{
		$this->filters['post_type_id'] = $id;
		session()->put('filters', $this->filters);

		$postType = PostType::find($id);

		return redirect()->route('posts', ['thematic' => $this->thematic, 'postType' => $postType]);
	}

	public function render()
	{
		return view('livewire.front.posts.cards');
	}
}
