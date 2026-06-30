<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Brand;

class BrandController extends Controller
{
	public function show(Brand $brand)
	{
		return view('front.brand.show', [
			'type' => 'brand',
			'brand' => $brand
		]);
	}
}
