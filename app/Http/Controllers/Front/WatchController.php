<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Watch;

class WatchController extends Controller
{
	public function show(Watch $watch)
	{
		return view('front.watch.show', [
			'bezelColors' => $watch->bezelColors,
			'bezelMarkings' => $watch->bezelMarkings,
			'bezelMaterials' => $watch->bezelMaterials,
			'braceletClasp' => $watch->braceletClasp,
			'braceletClaspColors' => $watch->braceletClaspColors,
			'braceletClaspMaterials' => $watch->braceletClaspMaterials,
			'braceletColor' => $watch->braceletColor,
			'braceletMaterials' => $watch->braceletMaterials,
			'braceletMicroAdjustementSystem' => $watch->braceletMicroAdjustementSystem,
			'braceletStitchingColors' => $watch->braceletStitchingColors,
			'braceletStyle' => $watch->braceletStyle,
			'caseColors' => $watch->caseColors,
			'caseMaterials' => $watch->caseMaterials,
			'complications' => $watch->complications,
			'crownColors' => $watch->crownColors,
			'crownMaterials' => $watch->crownMaterials,
			'crystalMaterials' => $watch->crystalMaterials,
			'dialColors' => $watch->dialColors,
			'dialMarkerColors' => $watch->dialMarkerColors,
			'dialMarkerLumeColors' => $watch->dialMarkerLumeColors,
			'dialMarkerTypes' => $watch->dialMarkerTypes,
			'dialTextures' => $watch->dialTextures,
			'dialType' => $watch->dialType,
			'movement' => $watch->movement,
			'type' => 'watch',
			'watch' => $watch
		]);
	}
}
