<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use App\Enums\InformationStatus;

class Brand extends Model implements Viewable, HasMedia
{
	use HasSlug, InteractsWithMedia, InteractsWithViews, SoftDeletes;

	protected $fillable = [
		'id',
		'slug',
		'name',
		'logo',
		'description',
		'nationality',
		'external_link',
		'status',
		'admin_id',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'status' => InformationStatus::class,
			'created_at' => 'date:Y-m-d h:i:s',
			'updated_at' => 'date:Y-m-d h:i:s',
			'deleted_at' => 'datetime'
		];
	}

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

	public function admin()
	{
		return $this->belongsTo(Admin::class);
	}

	public function address(): MorphOne
	{
		return $this->morphOne(Address::class, 'model');
	}

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('photos');
	}

	public function registerMediaConversions(Media $media = null): void
	{
		$this->addMediaConversion('optimized')
			->performOnCollections('photos')
			->width(1280)
			->height(1280);
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
}
