<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
	/**
	 * Admin dashboard
	 */
	public function index()
	{
		return view('admin.dashboard', [
			'countPosts' => Post::all()->count(),
			'countUsers' => User::all()->count()
		]);
	}
}
