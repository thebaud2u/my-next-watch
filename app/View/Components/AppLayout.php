<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\PostType;
use App\Models\Thematic;

class AppLayout extends Component
{
	/**
	 * Constructor
	 * Pass parameters to the layout view
	 *
	 * @param Thematic  $currentThematic
	 * @param PostType  $PostType
	 */
	public function __construct(public Thematic $currentThematic, public PostType $currentPostType)
	{
	}

	/**
	 * Get the view / contents that represents the component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render()
	{
		return view('components.layouts.app');
	}
}
