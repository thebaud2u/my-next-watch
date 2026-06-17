<?php

namespace App\Http\Controllers\Front\Space\Favorites;

use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
	public function index()
	{
		return view('front.space.favorites.index');
	}
}
