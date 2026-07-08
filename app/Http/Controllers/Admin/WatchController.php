<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\Watch;

class WatchController extends Controller
{
	/**
	 * Watches dashboard
	 */
	public function index()
	{
		return view('admin.watches.watches');
	}

	/**
	 * Create watch
	 */
	public function createWatch()
	{
		$watch = Watch::whereNull('collection_id')
			->whereNull('movement_id')
			->first();

		if(!$watch) {
			$watch = new Watch;
			$watch->admin_id = Auth::guard('admin')->user()->id;
			$watch->name = '';
			$watch->reference = '';
			$watch->bezel = [
				'color'=> [],
				'direction' => 'unidirectional',
				'marking' => [],
				'material'=> []
			];
			$watch->bracelet = [
				'clasp' => null,
				'clasp_color' => [],
				'clasp_material' => [],
				'material'=> [],
				'micro_adjustement' => true,
				'micro_adjustement_system' => 2,
				'stitching' => false,
				'stitching_color' => [],
				'style'=> null
			];
			$watch->case = [
				'color' => [],
				'diameter' => null,
				'lug_to_lug' => null,
				'lug_width' => null,
				'material' => [],
				'open_case_back' => false,
				'sapphire_crystal_case_back' => false,
				'thickness' => null,
				'waterproofness' => null
			];
			$watch->crown = [
				'color'=> [],
				'detail'=> null,
				'material'=> [],
				'screwed_down' => true
			];
			$watch->crystal = [
				'domed' => true,
				'material'=> null
			];
			$watch->dial = [
				'color' => [],
				'domed' => false,
				'marker_color' => [],
				'marker_lume' => true,
				'marker_lume_color' => [],
				'marker_type' => [],
				'textured' => false
			];
			$watch->specificities = [
				'complication' => [],
				'power_reserve' => null
			];
			$watch->admin_id = Auth::guard('admin')->user()->id;
			$watch->save();
		}

		return view('admin.watches.create-watch', [
			'watch' => $watch
		]);
	}

	/**
	 * Update watch
	 */
	public function updateWatch(Watch $watch)
	{
		return view('admin.watches.update-watch', compact('watch'));
	}
}
