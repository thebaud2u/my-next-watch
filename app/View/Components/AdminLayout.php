<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminLayout extends Component
{
	/**
	 * Constructor
	 * Pass parameters to the layout view
	 */
	public function __construct()
	{
	}

	/**
	 * Get the view / contents that represents the component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render()
	{
		return view('components.layouts.admin');
	}
}
