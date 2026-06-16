<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\{Post, PostType };

class SpaceLayout extends Component
{
	/**
	 * Constructor
	 * Pass parameters to the layout view
	 *
	 * @param PostType  $currentPostType
	 * @param Post  $post
	 */
	public function __construct(public PostType $currentPostType, public ?Post $post = null)
	{
	}

	/**
	 * Get the view / contents that represents the component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render()
	{
		return view('components.layouts.space');
	}
}
