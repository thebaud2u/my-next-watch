<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Collection;

class CollectionController extends Controller
{
	public function show(Collection $collection)
	{
		return view('front.collection.show', [
			'type' => 'collection',
			'collection' => $collection
		]);
	}
}
