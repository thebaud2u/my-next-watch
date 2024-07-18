<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Carbon\Carbon;

use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\PermissionRegistrar;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Facades\CauserResolver;
use Spatie\Activitylog\Traits\LogsActivity;

use Cmgmyr\Messenger\Traits\Messagable;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Overtrue\LaravelFavorite\Traits\Favoriter;
use Overtrue\LaravelFollow\Traits\Follower;
use Overtrue\LaravelFollow\Traits\Followable;

class User extends Authenticatable implements HasMedia
{
	use Favoriter, Follower, Followable, HasApiTokens, HasRoles, HasSlug, InteractsWithMedia, LogsActivity, Messagable, Notifiable, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'title_id',
		'gender_id',
		'thematic_id',
		'sector_id',
		'activity_id',
		'type',
		'slug',
		'name',
		'first_name',
		'last_name',
		'job_title',
		'email',
		'email_verified_at',
		'last_logon',
		'birth_date',
		'other',
		'phone',
		'mobile_phone',
		'values',
		'deleted_at'
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'last_logon' => 'datetime',
		'created_at' => 'date:Y-m-d h:i:s',
		'updated_at' => 'date:Y-m-d h:i:s',
		'deleted_at' => 'datetime',
		'values' => AsCollection::class
	];

	/**
	 * The events that wil be automatically logged
	 *
	 * @var array<int, string>
	 */
	protected static $recordEvents = ['created', 'updated', 'deleted', 'restored'];

	/**
	 * Get the options for generating the slug.
	 *
	 * @return SlugOptions
	 */
	public function getSlugOptions() : SlugOptions
	{
		return SlugOptions::create()
			->saveSlugsTo('slug')
			->generateSlugsFrom('name');
	}

	/**
	 * Set activity log options
	 *
	 * @see https://spatie.be/docs/laravel-activitylog/v4/api/log-options
	 *
	 * @return  \Spatie\Activitylog\LogOptions
	 */
	public function getActivitylogOptions(): LogOptions
	{
		CauserResolver::setCauser((empty(Auth::guard('admin')->user()->id)) ? Auth::guard('web')->user() : Auth::guard('admin')->user());
		$by = (! empty(Auth::guard('admin')->user()->id)) ? ' by Admin #:causer.id (:causer.email)' : ((! empty(Auth::guard('web')->user()->id) && Auth::guard('web')->user()->id == $this->id) ? '' : ' by CLI/API');

		return LogOptions::defaults()
			->useLogName('user')
			->setDescriptionForEvent(fn(string $eventName) => 'User #:subject.id (:subject.email) has been '.$eventName.$by)
			->logAll()
			->logExcept(['last_logon', 'updated_at'])
			->dontLogIfAttributesChangedOnly(['last_logon', 'updated_at'])
			->logOnlyDirty();
	}

	public function registerMediaCollections(): void
	{
		$this
			->addMediaCollection('avatar')
			->singleFile();
	}

	public function registerMediaConversions(Media $media = null): void
	{
		$this->addMediaConversion('optimized')
			->performOnCollections('avatar')
			->width(360)
			->height(360);
	}

	public function title()
	{
		return $this->belongsTo(Title::class);
	}

	public function gender()
	{
		return $this->belongsTo(Gender::class);
	}

	public function thematic()
	{
		return $this->belongsTo(Thematic::class);
	}

	public function sector()
	{
		return $this->belongsTo(Sector::class);
	}

	public function activity()
	{
		return $this->belongsTo(Activity::class);
	}

	public function address(): MorphOne
	{
		return $this->morphOne(Address::class, 'model');
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(Subscription::class);
	}

	public function latestSubscriptions()
	{
		return $this->hasMany(Subscription::class)->latest()->get();
	}

	// Check if the user has a subscription of the given offer's slug
	// use isPublishable() on the result to know if a credit is available on the returned offer, is returned any
	public function hasOfferSubscription($offerSlug)
	{
		$found = false;

		foreach($this->latestSubscriptions() as $subscription) {
			if($subscription->offer->slug == $offerSlug) {
				$found = $subscription;
				break;
			}
		}

		return $found;
	}

	public function hasCreditAvailable($offerSlug)
	{
		$found = false;

		foreach($this->latestSubscriptions() as $subscription) {
			if($subscription->offer->slug == $offerSlug && ($subscription->end_date >= now() && $subscription->remaining_quantity > 0)) {
				$found = true;
				break;
			}
		}

		return $found;
	}

	public function hasPostCreditAvailable($type)
	{
		$query = $this->subscriptions()
			->whereHas('offer', function($whereHas) {
				$whereHas->whereIn('type', ['web','print']);
			})
			->where('remaining_quantity', '>', 0)
			->where('end_date', '>=', Carbon::now()->format('Y-m-d'));

		if($type == 'count') $query = $query->count();
		elseif($type == 'get') $query = $query->get();

		return $query ;
	}

	public function countCreditAvailable($offerSlug)
	{
		$found = 0;

		foreach($this->latestSubscriptions() as $subscription) {
			if($subscription->offer->slug == $offerSlug && ($subscription->end_date >= now() && $subscription->remaining_quantity > 0)) $found += $subscription->remaining_quantity;
		}

		return $found;
	}

	public function contacted($user)
	{
		$count = 0;

		foreach($this->posts as $post) {
			$count += $post->responses()
				->whereHas('user', function($whereHas) use($user) {
					$whereHas->where('id', '=', $user->id);
				})
				->count();
		}

		return $count;
	}

	public function hasApplied(Post $post)
	{
		/*
		En attente de la branche d'Adrien
		return $post->responses()->whereHas('questioner', function($whereHas) {
				$whereHas->where('id', '=', $this->id);
			})
			->count();
		*/
		return 0;
	}

	public function hasContacted(Post $post)
	{
		return $post->responses()
			->where('questioner_id', Auth::guard('web')->user()->id)
			->count();
	}

	/**
	 * HasViewed or not a given element
	 *
	 * @param class User or class Post
	 * @param int id
	 * @return int
	 */
	public function hasViewed($elementType, $elementId)
	{
		return UsersViews::whereHas('user', function($whereHas) {
				$whereHas->where('id', '=', $this->id);
			})
			->where('element_type', '=', $elementType)
			->where('element_id', '=', $elementId)
			->count();
	}

	/**
	 * HasViewed or not a given element
	 *
	 * @param class User or class Post
	 * @param int id
	 * @return int
	 */
	public function recentlyViewedPosts()
	{
		$viewedPosts = UsersViews::whereHas('user', function($whereHas) {
				$whereHas->where('id', '=', $this->id);
			})
			->where('element_type', '=', Post::class)
			->select('element_id')
			->limit(9)
			->get()
			->toArray();

		return Post::whereIn('id', $viewedPosts)
			->get();
	}
}
