<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Faq;
use App\Models\Thematic;

use App\Enums\PostStatesEnum;

class HomeController extends Controller
{
	/**
	 * Home
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$thematics = Thematic::all();

		return view('front.home', compact('thematics'));
	}

	public function faq()
	{
		$faq = Faq::published()
			->first();

		if($faq) {
			return view('front.faq', [
				'faq' => $faq
			]);
		}
		else return redirect()->route('home');
	}
}
