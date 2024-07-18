<?php

namespace App\Http\Controllers\Front\Space\Favorites;

use App\Http\Controllers\Controller;

use Auth;

use App\Models\Post;
use App\Models\User;

class FavoritesController extends Controller
{
	/**
	 * Display favorites & followed
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('front.space.favorites.index');
	}

	public function favorite(Post $post)
	{
		Auth::guard('web')->user()->toggleFavorite($post);

		$favorited = Auth::guard('web')->user()->hasFavorited($post);
		activity('post')
			->performedOn($post)
			->causedBy((empty(Auth::guard('admin')->user()?->id)) ? Auth::guard('web')->user() : Auth::guard('admin')->user())
			->event(($favorited ? '' : 'un').'favorited')
			->log('User #'.Auth::guard('web')->user().' has '.($favorited ? '' : 'un').'favorited Post #:subject.id');

		return back()->with('info', __('Post :what favorites', [
			'what' => ((Auth::guard('web')->user()->hasFavorited($post)) ? __('added to') : __('removed from'))
		]));
	}

	public function follow(User $user)
	{
		Auth::guard('web')->user()->toggleFollow($user);

		$following = Auth::guard('web')->user()->isFollowing($user);
		activity('user')
			->performedOn($user)
			->causedBy((empty(Auth::guard('admin')->user()?->id)) ? Auth::guard('web')->user() : Auth::guard('admin')->user())
			->event(($following ? '' : 'un').'following')
			->log('User #'.Auth::guard('web')->user()->id.' is now '.($following ? '' : 'un').'following User #:subject.id');

		return back()->with('info', __('Profile :what followed', [
			'what' => (($following) ? __('added to') : __('removed from'))
		]));
	}
}
