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
			'braceletType' => $watch->getBraceletType()->slug,
			'caseColors' => $watch->caseColors,
			'caseMaterials' => $watch->caseMaterials,
			'caseFinishes' => $watch->caseFinishes,
			'caseSurfaceTreatments' => $watch->caseSurfaceTreatments,
			'complications' => $watch->complications,
			'crownColors' => $watch->crownColors,
			'crownMaterials' => $watch->crownMaterials,
			'crystalMaterials' => $watch->crystalMaterials,
			'dialColors' => $watch->dialColors,
			'dialFinishes' => $watch->dialFinishes,
			'dialMarkerColors' => $watch->dialMarkerColors,
			'dialMarkerLumeColors' => $watch->dialMarkerLumeColors,
			'dialMarkerTypes' => $watch->dialMarkerTypes,
			'dialType' => $watch->dialType,
			'movement' => $watch->movement,
			'watch' => $watch
		]);
	}
}
