<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Watch;

class WatchController extends Controller
{
	public function show(Watch $watch)
	{
		return view('front.watch.show', [
			'caseColors' => $watch->caseColors,
			'caseMaterials' => $watch->caseMaterials,
			'complications' => $watch->complications,
			'movement' => $watch->movement,
			'type' => 'watch',
			'watch' => $watch
		]);
	}
}
