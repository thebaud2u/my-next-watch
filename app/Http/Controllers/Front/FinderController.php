<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class FinderController extends Controller
{
	public function index()
	{
		return view('front.finder');
	}
}
