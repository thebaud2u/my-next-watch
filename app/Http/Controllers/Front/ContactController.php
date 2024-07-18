<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
	public function index()
	{
		return view('front.contact.contact');
	}
}
