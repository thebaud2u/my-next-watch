<?php

namespace App\Http\Controllers\Front\Posts;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\{ Thread, Participant };

use App\Enums\{ PostStatesEnum, ResponseStatesEnum };
use App\Models\{ Message, Post, PostType, Response, Search, Thematic, UsersViews };

class PostController extends Controller
{
	public function index(Thematic $thematic, PostType $postType, ?Search $search = null)
	{
		// Si un post type est définie, on doit afficher la recherche avancer et lister les annonces
		// Sinon, si une thématique est définie on doit afficher uniquement les cards d'annonces de la thématique
		// sinon, on affichage toutes les annonces de toutes les thématiques
		$thematicHome = (!empty($postType->id))? false : true;

		if (empty($search?->user_id) || $search?->user_id != Auth::guard('web')->user()->id) {
			// 404 ? or :
			$search = new Search;
		}

		return view('front.posts.index', compact('thematic', 'postType', 'thematicHome', 'search'));
	}

	/**
	 * Display the specified post
	 *
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\View\View
	 */
	public function show(Post $post)
	{
		if($post->state->value != PostStatesEnum::Published->value && (empty(Auth::guard('web')->user()->id) || $post->user_id != Auth::guard('web')->user()->id)) {
			return redirect()->route('jobs')->withError(__('This post is not yet published'));
		}

		views($post)->record();

		if($post->address->city || $post->address->custom_city) {
			$street = $post->address->street ? $post->address->street.',' : '';
			$city = $post->address->city ? $post->address->city->name : $post->address->custom_city;
			$code = $post->address->city->zip_code ? $post->address->city->zip_code : (($post->address->custom_city && $post->address->custom_postcode) ? $post->address->custom_postcode : '');

			$location = $street.' '.$city.', '.$code.', '.$post->address->country->name;
		}
		elseif($post->address->department) $location = $post->address->department->name.' ('.$post->address->department->code.')';
		elseif($post->address->region) $location = $post->address->region->name;
		elseif($post->address->country) $location = $post->address->country->name;
		else $location = __('Unknown location');

		// $bHasApplyied = false;
		$hasContacted = false;
		$hasClosed = false;
		$response = new Response();
		if (Auth::guard('web')->check()) {
			// if (Auth::guard('web')->user()->hasRole('applicant')) $bHasApplyied = (Auth::guard('web')->user()->hasApplied($post) > 0);
			if (Auth::guard('web')->user()->hasRole('registered')) {
				$hasContacted = (Auth::guard('web')->user()->hasContacted($post) > 0);
				$response = Response::select('responses.*', 'participants.hidden')
					->join('participants', function (JoinClause $join) {
						$join->on('participants.thread_id', '=', 'responses.thread_id')
							->where('participants.user_id', Auth::guard('web')->user()->id);
					})
					->where('post_id', $post->id)
					->where('poster_id', $post->user_id)
					->where('questioner_id', Auth::guard('web')->user()->id)
					->first();
				$hasClosed = (! empty($response->hidden));
			}

			// UsersViews by JC ♥
			UsersViews::firstOrCreate([
				'user_id' => Auth::guard('web')->user()->id,
				'element_type' => Post::class,
				'element_id' => $post->id
			]);
		}

		$maxPhotos = 0;
		if($post->hasOption('photo.1')) $maxPhotos = 1;
		else if($post->hasOption('photo.3')) $maxPhotos = 3;
		else if($post->hasOption('photo.10')) $maxPhotos = 10;

		return view('front.posts.show', [
			'post' => $post,
			'maxPhotos' => $maxPhotos,
			'location' => $location,
			// 'hasApplyied' => $bHasApplyied,
			'hasContacted' => $hasContacted,
			'hasClosed' => $hasClosed,
			'response' => $response,
		]);
	}

	/**
	 * Toggle favorite state
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function contact(Request $request, Post $post)
	{
		if (empty(trim($request->message))) {

			return redirect()->route('show-post', ['post' => $post])
				->withError(__('Message field cannot be empty'));

		} else {
			$response = Response::where('post_id', $post->id)
				->where('poster_id', $post->user_id)
				->where('questioner_id', Auth::guard('web')->user()->id)
				->first();

			$thread = new Thread();
			if (empty($response?->thread_id)) {
				$thread = Thread::create([
					'subject' => __('Post #').$post->id,
				]);

				Participant::create([
					'thread_id' => $thread->id,
					'user_id' => Auth::guard('web')->user()->id,
					'last_read' => new Carbon(),
				]);

				Participant::create([
					'thread_id' => $thread->id,
					'user_id' => $post->user_id,
				]);

			} else {
				$thread = Thread::where('id', $response->thread_id)->first();
				$participants = Participant::where('thread_id', $thread->id)->get();

				foreach ($participants as $participant) {
					if (! empty($participant->hidden)) {
						$participant->hidden = null;
						$participant->save();
					}
				}
			}

			$new = false;
			if (empty($response?->id)) {
				$response = Response::create([
					'post_id' => $post->id,
					'poster_id' => $post->user_id,
					'questioner_id' => Auth::guard('web')->user()->id,
					'state' => ResponseStatesEnum::Received,
					'thread_id' => $thread->id,
					'values' => ['body' => $request->input('message')],
				]);
				$new = true;
			} else {
				if ($response->state == ResponseStatesEnum::Sent) {
					$response->state = ResponseStatesEnum::Received;
					$response->save();
				}
			}

			$message = Message::create([
				'thread_id' => $thread->id,
				'user_id' => Auth::guard('web')->user()->id,
				'body' => $request->input('message'),
			]);

			$event = $new ? 'created' : 'reopened';
			activity('response')
				->performedOn($response)
				->causedBy((empty(Auth::guard('admin')->user()?->id)) ? Auth::guard('web')->user() : Auth::guard('admin')->user())
				->event($event)
				->log('User #'.Auth::guard('web')->user()->id.' ('.Auth::guard('web')->user()->email.') '.$event.' Response #:subject.id (Thread #'.$thread->id.', '
					.'new Message #'.$message->id.' to User #'.$post->user_id.')');

			return redirect()->route('show-post', ['post' => $post])
				->withSuccess(__('Message successfully sent to the advertiser.'));

		}
	}
}
