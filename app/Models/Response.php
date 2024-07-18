<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Cmgmyr\Messenger\Models\Thread;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Facades\CauserResolver;

use App\Enums\ResponseStatesEnum;

// use App\Notifications\ResponseCreated;
// use App\Notifications\ResponseUpdated;

class Response extends Model implements HasMedia
{
	use InteractsWithMedia;

	protected $fillable = [
		'post_id',
		'poster_id',
		'questioner_id',
		'thread_id',
		'state',
		'values',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'values' => AsCollection::class,
			'state' => ResponseStatesEnum::class,
		];
	}

	/**
	 * Set activity log options
	 *
	 * @return  \Spatie\Activitylog\LogOptions
	 */
	public function getActivitylogOptions(): LogOptions
	{
		CauserResolver::setCauser((empty(Auth::guard('admin')->user()->id)) ? ((empty(Auth::guard('web')->user())) ? null : Auth::guard('web')->user()) : Auth::guard('admin')->user());
		$by = (! empty(Auth::guard('admin')->user()->id)) ? ' by Admin #:causer.id (:causer.email)' : ((! empty(Auth::guard('web')->user()->id)) ? ' by User #:causer.id (:causer.email)' : ' by CLI/API');

		return LogOptions::defaults()
			->useLogName('response')
			->setDescriptionForEvent(fn(string $eventName) => 'Response #:subject.id has been '.$eventName.$by)
			->logAll()
			->logOnlyDirty();
	}

	public function post()
	{
		return $this->belongsTo(Post::class)
			->withTrashed();
	}

	public function poster()
	{
		return $this->belongsTo(User::class, 'poster_id', 'id')
			->withTrashed();
	}

	public function questioner()
	{
		return $this->belongsTo(User::class, 'questioner_id', 'id')
			->withTrashed();
	}

	public function thread()
	{
		return $this->belongsTo(Thread::class)
			->withTrashed();
	}

	// public function getLatestMessage()
	// {
	// 	return $this->thread()->getLatestMessageAttribute();
	// }

	public function scopeParticipation(Builder $query): void
	{
		$query->where('poster_id', Auth::guard('web')->user()->id)
			->orWhere('questioner_id', Auth::guard('web')->user()->id);
	}

	// public static function boot()
	// {
	// 	parent::boot();
	// 	static::created(function($model) {
	// 		$model->post->user->notify(new ResponseCreated($model));

	// 		// $thread = Thread::create([
	// 		// 	'subject' => __('Post #').$model->post->id,
	// 		// ]);

	// 		// $model->thread_id = $thread->id;
	// 		// $model->saveQuietly();

	// 		// Participant::create([
	// 		// 	'thread_id' => $thread->id,
	// 		// 	'user_id' => $model->questioner_id,
	// 		// 	'last_read' => new Carbon(),
	// 		// ]);

	// 		// Participant::create([
	// 		// 	'thread_id' => $thread->id,
	// 		// 	'user_id' => $model->post->user_id,
	// 		// 	'last_read' => new Carbon(),
	// 		// ]);
	// 	});

	// 	/*
	// 		static::updated(function($model) {
	// 			$model->user->notify(new ResponseUpdated($model));
	// 		});
	// 	*/
	// }

	public function canAnswer()
	{
		/*
			si ça n'est pas (une proposition et que le user connecté est l'auteur de l'annonce)
			et si ça n'est pas (une candidature et que le user connecté est l'auteur de la candidature)
		*/
		// return !($this->type->name == 'proposal' && $this->post->user->id == Auth::guard('web')->user()->id) &&
		// 	!($this->type->name == 'application' && $this->user->id == Auth::guard('web')->user()->id) &&
		// 	$this->state == ResponseStatesEnum::Received;

		return Auth::check() && $this->state == ResponseStatesEnum::Received &&
			($this->poster_id == Auth::guard('web')->user()?->id || $this->questioner_id != Auth::guard('web')->user()?->id);
	}
}
