<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\PermissionRegistrar;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable implements HasMedia
{
	use HasRoles, HasSlug, InteractsWithMedia, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'gender',
		'firstname',
		'lastname',
		'nickname',
		'slug',
		'email',
		'birthday',
		'phone',
		'mobile',
		'values',
		'experience_id',
		'email_verified_at',
		'last_logon'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'values' => 'collection',
		'birthday' => 'date',
		'email_verified_at' => 'datetime',
		'last_logon' => 'datetime',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
		'deleted_at' => 'datetime'
	];

	// Tools
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
		$this->addMediaCollection('avatar')
			->singleFile();
	}

	public function registerMediaConversions(?Media $media = null): void
	{
		$this->addMediaConversion('optimized')
			->performOnCollections('avatar')
			->width(360)
			->height(360);
	}

	// Relations
	public function experience(): BelongsTo
	{
		return $this->belongsTo(Experience::class);
	}
	
	public function gender(): BelongsTo
	{
		return $this->belongsTo(Gender::class);
	}

	public function title(): BelongsTo
	{
		return $this->belongsTo(Title::class);
	}

	// Functions
	/**
	 * HasViewed or not a given element
	 *
	 * @param class User or class Post
	 * @param int id
	 * @return int
	 */
	public function hasViewed($elementType, $elementId): int
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
	public function recentlyViewedWatches(): Collection
	{
		$viewedWatches = UsersViews::whereHas('user', function($whereHas) {
				$whereHas->where('id', '=', $this->id);
			})
			->where('element_type', '=', Watch::class)
			->select('element_id')
			->limit(9)
			->get()
			->toArray();

		return Watch::whereIn('id', $viewedWatches)
			->get();
	}

	// To Do :)
	/**
	 * Returns the number of saved search the current user has
	 *
	 * @param class User
	 * @return int
	 */
	public function savedSearch()
	{
		return 0;
	}
}
