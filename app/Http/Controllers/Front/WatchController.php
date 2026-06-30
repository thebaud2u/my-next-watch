<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Watch;

class WatchController extends Controller
{
	public function show(Watch $watch)
	{
		return view('front.watch.show' [
			'type' => 'watch',
			'watch' => $watch
		]);
	}
}
