<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//use App\Models\Faq;

class HomeController extends Controller
{
	/**
	 * Home
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('front.home');
	}
}
