<?php

namespace App\Http\Controllers\Front\Pages;

use App\Http\Controllers\Controller;

class LegalPageController extends Controller
{
	/**
	 * Politique cookies
	 *
	 * @return \Illuminate\View\View
	 */
	public function cookies()
	{
		return view('front.legal-pages.cookies');
	}

	/**
	 * Qui sommes-nous
	 *
	 * @return \Illuminate\View\View
	 */
	public function aboutUs()
	{
		return view('front.legal-pages.about-us');
	}
}
