<?php

namespace App\Http\Controllers\Front\Pages;

use App\Http\Controllers\Controller;

class LegalPageController extends Controller
{
	/**
	 * Conditions Générales d'utilisation
	 *
	 * @return \Illuminate\View\View
	 */
	public function cgu()
	{
		return view('front.legal-pages.cgu');
	}

	/**
	 * Conditions Générales de vente
	 *
	 * @return \Illuminate\View\View
	 */
	public function cgv()
	{
		return view('front.legal-pages.cgv');
	}

	/**
	 * Politique cookies
	 *
	 * @return \Illuminate\View\View
	 */
	public function cookies()
	{
		return view('front.legal-pages.cookies');
	}

	/**
	 * Mentions légales
	 *
	 * @return \Illuminate\View\View
	 */
	public function mentionsLegales()
	{
		return view('front.legal-pages.ml');
	}

	/**
	 * Mentions légales
	 *
	 * @return \Illuminate\View\View
	 */
	public function politiqueConfidentialite()
	{
		return view('front.legal-pages.pdc');
	}

	/**
	 * Qui sommes-nous
	 *
	 * @return \Illuminate\View\View
	 */
	public function quiSommesNous()
	{
		return view('front.legal-pages.quisommesnous');
	}
}
