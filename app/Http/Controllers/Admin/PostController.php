<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
	/**
	 * Display a listing of all posts
	 *
	 * @return view
	 */
	public function index()
	{
		return view('admin.posts.index');
	}
}
