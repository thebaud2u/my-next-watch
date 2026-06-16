<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{Breed, Faq, Species, Offer};

class HomeController extends Controller
{
	/**
	 * Home
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('front.home');
	}

	public function indexOffer()
	{
		$packOffers = Offer::where('type', 'pack')
			->get();

		$companyOffersSlug = Offer::where('type', 'company')
			->orderBy('slug', 'DESC')
			->pluck('slug')
			->toArray();

		$companyOffers = Offer::where('type', 'company')
			->orderByRaw("FIELD(slug, '" . implode("','", $companyOffersSlug) . "')")
			->get();

		$postOffersSlug = Offer::where('type', 'post')
			->orderBy('slug', 'DESC')
			->pluck('slug')
			->toArray();

		$postOffers = Offer::where('type', 'post')
			->orderByRaw("FIELD(slug, '" . implode("','", $postOffersSlug) . "')")
			->get();

		$professionnalActivityOffer = Offer::findBySlug('activite-secondaire');

		return view('front.home-offer', compact('packOffers', 'companyOffers', 'postOffers', 'professionnalActivityOffer'));
	}

	public function faq()
	{
		$faq = Faq::published()
			->first();

		if($faq) {
			return view('front.faq', [
				'faq' => $faq
			]);
		}
		else return redirect()->route('home');
	}
}
