<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SettingController extends Controller
{
	/**
	 * Settings of the project
	 */
	public function index()
	{
		return view('admin.settings.index');
	}
}
