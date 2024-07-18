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
	use Favoriter, Follower, Followable, HasApiTokens, HasRoles, HasSlug, InteractsWithMedia, Notifiable, SoftDeletes;

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
			->generateSlugsFrom('nickname');
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

	public function posts()
	{
		return $this->hasMany(Post::class);
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
