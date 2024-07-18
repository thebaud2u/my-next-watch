<?php

namespace App\Http\Controllers\Front\Space\Posts;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use DB;
use Str;

Use Carbon\Carbon;

use App\Enums\PostStatesEnum;

use App\Models\{ City, Country, Department, Region};

use App\Models\Address;
use App\Models\Bonus;
use App\Models\Media;
use App\Models\Offer;
use App\Models\Option;
use App\Models\Post;
use App\Models\PostPublication;
use App\Models\PostResponseType;
use App\Models\PostType;
use App\Models\Response;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\Thematic;
use App\Models\User;

class PostController extends Controller
{
	public function index()
	{
		return view('front.space.posts.my-posts');
	}

	public function showOffers(Thematic $thematic, PostType $postType)
	{
		if(Auth::guard('web')->user()->gender && Auth::guard('web')->user()->first_name != '' && Auth::guard('web')->user()->last_name != '') {
			$post = new Post;
			$change = false;

			if($thematic->id) $post->thematic_id = $thematic->id;
			if($postType->id) $post->post_type_id = $postType->id;

			return view('front.space.posts.show-offers', compact('thematic', 'post', 'postType', 'change'));
		}
		else return redirect()->route('space.account')->withError(__('Update your account\'s informations'));
	}

	public function create(Post $post)
	{
		return view('front.space.posts.create', compact('post'));
	}

	public function changeOffer(Post $post)
	{
		$change = true;

		$thematic = $post->thematic;
		$postType = $post->postType;

		return view('front.space.posts.show-offers', compact('thematic', 'post', 'postType', 'change'));
	}

	public function edit(Post $post)
	{
		return view('front.space.posts.edit', compact('post'));
	}

	public function destroy(Post $post)
	{
		$post->delete();

		return redirect()->route('space.posts.my-posts')
			->withSuccess(__('Post deleted successfully.'));
	}

	public function publish(Post $post)
	{
		$who = (empty(Auth::guard('admin')->user()?->id)) ? 'User #'.Auth::guard('web')->user()->id.' ('.Auth::guard('web')->user()->email.')' : 'Admin #'.Auth::guard('admin')->user()->id.' ('.Auth::guard('admin')->user()->email.')';

		if (!$post->offer->is_free) {
			$subscription = Subscription::with([
					'offer',
					'user'
				])
				->whereHas('offer', function($whereHas) use ($post) {
					$whereHas->where('id', '=', $post->offer->id);
				})
				->whereHas('user', function($whereHas) use ($post) {
					$whereHas->where('id', '=', Auth::guard('web')->user()->id);
				})
				->where(function($where) {
					$where->where('remaining_quantity', '>', 0)
						->where('end_date', '>=', Carbon::now());
				})
				->orderBy('created_at', 'ASC')
				->first();

			if($subscription) {
				$subscription->remaining_quantity--;
				$subscription->save();

				activity('subscription')
					->performedOn($subscription)
					->causedBy((empty(Auth::guard('admin')->user()?->id)) ? Auth::guard('web')->user() : Auth::guard('admin')->user())
					->event('credit-used')
					->log($who.' has used one credit (Offer #'.$post->offer->id.' / Subscription #:subject.id) on Post #'.$post->id);

				if($post->publications->isEmpty()) {
					PostPublication::create(
						[
							'post_id' => $post->id,
							'offer_id' => $post->offer->id,
							'subscription_id' => $subscription->id,
							'user_id' => Auth::guard('web')->user()->id,
						]
					);
				}
			}
			else {
				return redirect()->route('rates.index', [
					'compositionId' => 27,
				]);
			}
		}
		else {
			PostPublication::create(
				[
					'post_id' => $post->id,
					'offer_id' => $post->offer->id,
					'user_id' => Auth::guard('web')->user()->id,
				]
			);
		}

		if($post->offer->type == 'print') {
			$dateParution = $this->__getNextDate($post->thematic);
			if($dateParution['status'] == 'Success') $post->parution_date = Carbon::createFromFormat('d/m/Y', $dateParution['value'])->format('Y-m-d');
		}

		$post->state = PostStatesEnum::Published;
		$post->published_at = now();
		$post->refreshed_at = now();
		$post->archived_at = now()->addMonths(2);

		$post->save();

		activity('post')
			->performedOn($post)
			->causedBy((empty(Auth::guard('admin')->user()?->id)) ? Auth::guard('web')->user() : Auth::guard('admin')->user())
			->event('published')
			->log('Post #:subject.id has been published by '.$who);

		return redirect()->route('space.posts.my-posts');
	}

	public function unpublish(Post $post)
	{
		$post->state = PostStatesEnum::Draft;
		$post->published_at = null;
		$post->parution_date = null;
		$post->save();

		$who = (empty(Auth::guard('admin')->user()?->id)) ? 'User #'.Auth::guard('web')->user()->id.' ('.Auth::guard('web')->user()->email.')' : 'Admin #'.Auth::guard('admin')->user()->id.' ('.Auth::guard('admin')->user()->email.')';
		activity('post')
			->performedOn($post)
			->causedBy((empty(Auth::guard('admin')->user()?->id)) ? Auth::guard('web')->user() : Auth::guard('admin')->user())
			->event('unpublished')
			->log('Post #:subject.id has been unpublished by '.$who);

		return redirect()->route('space.posts.my-posts');
	}

	public function confirmOfferChange(Post $post)
	{
		if(!$post->offer->is_free) {
			$subscription = Subscription::with([
					'offer',
					'user'
				])
				->whereHas('offer', function($whereHas) use ($post) {
					$whereHas->where('id', '=', $post->offer->id);
				})
				->whereHas('user', function($whereHas) use ($post) {
					$whereHas->where('id', '=', Auth::guard('web')->user()->id);
				})
				->where(function($where) {
					$where->where('remaining_quantity', '>', 0)
						->where('end_date', '>=', Carbon::now());
				})
				->orderBy('created_at', 'ASC')
				->first();

			if($subscription) {
				$subscription->remaining_quantity--;
				$subscription->save();

				PostPublication::create(
					[
						'post_id' => $post->id,
						'offer_id' => $post->offer->id,
						'subscription_id' => $subscription->id,
						'user_id' => Auth::guard('web')->user()->id,
					]
				);

				if($post->offer->type == 'print') {
					$dateParution = $this->__getNextDate($post->thematic);
					if($dateParution['status'] == 'Success') $post->parution_date = Carbon::createFromFormat('d/m/Y', $dateParution['value'])->format('Y-m-d');
				}

				$post->state = PostStatesEnum::Published;
				$post->published_at = now();
				$post->refreshed_at = now();
				$post->archived_at = now()->addMonths(3);
				$post->save();
			}
			else {
				return redirect()->route('rates.index', [
					'compositionId' => 27,
				])->withError(__('No credit found, please contact the customer service using our contact form'));
			}
		}
		else {
			PostPublication::create(
				[
					'post_id' => $post->id,
					'offer_id' => $post->offer->id,
					'user_id' => Auth::guard('web')->user()->id,
				]
			);
		}

		$who = (empty(Auth::guard('admin')->user()?->id)) ? 'User #'.Auth::guard('web')->user()->id.' ('.Auth::guard('web')->user()->email.')' : 'Admin #'.Auth::guard('admin')->user()->id.' ('.Auth::guard('admin')->user()->email.')';
		activity('post')
			->performedOn($post)
			->causedBy((empty(Auth::guard('admin')->user()?->id)) ? Auth::guard('web')->user() : Auth::guard('admin')->user())
			->event('offer-changed')
			->log($who.' has changed Offer #'.$post->offer->id
				.((empty($subscription?->id)) ? '' : ' (Subscription #'.$subscription->id.')')
				.' on Post #:subject.id');

		return redirect()->back()->withSuccess(__('Your post now owns the ":offer" offer', ['offer' => $post->offer->name]));
	}

	public function extendOffer(Post $post)
	{
		if (!$post->offer->is_free) {
			if($post->user->hasCreditAvailable($post->offer->slug)) {
				$subscription = Subscription::with([
						'offer',
						'user'
					])
					->whereHas('offer', function($whereHas) use ($post) {
						$whereHas->where('id', '=', $post->offer->id);
					})
					->whereHas('user', function($whereHas) use ($post) {
						$whereHas->where('id', '=', Auth::guard('web')->user()->id);
					})
					->where(function($where) {
						$where->where('remaining_quantity', '>', 0)
							->where('end_date', '>=', Carbon::now());
					})
					->orderBy('created_at', 'ASC')
					->first();

				if($subscription) {
					$subscription->remaining_quantity--;
					$subscription->save();

					PostPublication::create(
						[
							'post_id' => $post->id,
							'offer_id' => $post->offer_id,
							'subscription_id' => $subscription->id,
							'user_id' => Auth::guard('web')->user()->id,
						]
					);
				}
				else {
					return redirect()->route('rates.index', [
						'compositionId' => 27,
					])->withError(__('Your post can\'t be extended, please verify that you own an :offer credit', ['offer' => $post->offer->name]));
				}
			}
		}
		else {
			PostPublication::create(
				[
					'post_id' => $post->id,
					'offer_id' => $post->offer_id,
					'user_id' => Auth::guard('web')->user()->id,
				]
			);
		}

		$post->refreshed_at = now();

		if($post->archived_at < now()) $post->archived_at = Carbon::now()->addMonths('3');
		else $post->archived_at = Carbon::parse($post->archived_at)->addMonths('3');

		$post->save();

		$who = (empty(Auth::guard('admin')->user()?->id)) ? 'User #'.Auth::guard('web')->user()->id.' ('.Auth::guard('web')->user()->email.')' : 'Admin #'.Auth::guard('admin')->user()->id.' ('.Auth::guard('admin')->user()->email.')';
		activity('post')
			->performedOn($post)
			->causedBy((empty(Auth::guard('admin')->user()?->id)) ? Auth::guard('web')->user() : Auth::guard('admin')->user())
			->event('offer-extended')
			->log($who.' has extended Offer #'.$post->offer->id
				.((empty($subscription?->id)) ? '' : ' (Subscription #'.$subscription->id.')')
				.' on Post #:subject.id');

		return redirect()->back()->withSuccess(__('Your post has been extended successfully'));
	}

	public function upload(Request $request)
	{
		if (!empty($_FILES['upload'])) {
			if (!empty($_FILES['upload']['tmp_name'])) {
				$fileName = time().'.'.$request->file('upload')->extension();
				$request->file('upload')->move(storage_path('app/public/posts/'), $fileName);

				return response()->json(['url' => '/storage/posts/'.$fileName]);
			}
		}

		return response()->json(['error' => ['message' => 'The image upload failed']]);
	}
}
