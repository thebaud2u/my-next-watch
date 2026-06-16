<?php

namespace App\Http\Controllers\Front\Space\Account;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
	/**
	 * Display dashboard page
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('front.space.account.index');
	}

	/**
	 * Display account page
	 * string $active 'profile' ou 'account' permet de définir à laquelle des deux étapes l'on souhaite initialiser la page
	 *
	 * @return \Illuminate\View\View
	 */
	public function account($active = 'account')
	{
		return view('front.space.account.my-account', compact('active'));
	}
}
