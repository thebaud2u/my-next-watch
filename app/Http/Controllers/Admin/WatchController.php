<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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
		$newWatch = new Watch;
		$newWatch->admin_id = Auth::guard('admin')->user()->id;
		$newWatch->name = '';
		$newWatch->reference = '';
		$newWatch->bezel = [
			'color'=> [],
			'direction' => 'unidirectional',
			'marking' => [],
			'material'=> []
		];
		$newWatch->bracelet = [
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
		$newWatch->case = [
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
		$newWatch->crown = [
			'color'=> [],
			'detail'=> null,
			'material'=> [],
			'screwed_down' => true
		];
		$newWatch->crystal = [
			'domed' => true,
			'material'=> null
		];
		$newWatch->dial = [
			'color' => [],
			'domed' => false,
			'marker_color' => [],
			'marker_lume' => true,
			'marker_lume_color' => [],
			'marker_type' => [],
			'textured' => false
		];
		$newWatch->specification = [
			'complication' => [],
			'power_reserve' => null
		];
		$newWatch->admin_id = Auth::guard('admin')->user()->id;
		$newWatch->save();

		return view('admin.watches.create-watch', compact('watch'));
	}

	/**
	 * Update watch
	 */
	public function updateWatch(Watch $watch)
	{
		return view('admin.watches.update-watch', compact('watch'));
	}
}
