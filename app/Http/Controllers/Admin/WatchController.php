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
		return view('admin.watches');
	}
}
