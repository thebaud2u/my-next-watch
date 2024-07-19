<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
		'title_id',
		'gender_id',
		'slug',
		'nickname',
		'first_name',
		'last_name',
		'email',
		'last_logon',
		'birth_date',
		'phone',
		'mobile_phone',
		'experience_id',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'last_logon' => 'datetime',
		'created_at' => 'date:Y-m-d h:i:s',
		'updated_at' => 'date:Y-m-d h:i:s',
		'deleted_at' => 'datetime'
	];

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

	public function experience()
	{
		return $this->belongsTo(Experience::class);
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
	public function recentlyViewedWatches()
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
}
