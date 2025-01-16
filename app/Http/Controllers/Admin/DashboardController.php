<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\User;
use App\Models\Watch;

class DashboardController extends Controller
{
	/**
	 * Admin dashboard
	 */
	public function index()
	{
		return view('admin.dashboard', [
			'admins' => Admin::all()->count(),
			'users' => User::all()->count(),
			'watches' => Watch::all()->count()
		]);
	}
}
