<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\{ Post, PostType, Thematic };

class SpaceLayout extends Component
{
	/**
	 * Constructor
	 * Pass parameters to the layout view
	 *
	 * @param Thematic  $currentThematic
	 * @param PostType  $currentPostType
	 * @param Post  $post
	 * @param string|null  $breadcrumb
	 */
	public function __construct(public Thematic $currentThematic, public PostType $currentPostType, public ?Post $post = null, public ?string $breadcrumb = null)
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
