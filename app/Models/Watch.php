<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsCollection;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use App\Enums\WatchStatesEnum;

class Watch extends Model implements Viewable, HasMedia
{
	use HasSlug, InteractsWithMedia, InteractsWithViews, SoftDeletes;

	protected $fillable = [
		'id',
		'user_id',
		'type_id',
		'brand_id',
		'collection_id',
		'slug',
		'name',
		'description',
		'characteristics',
		'state',
		'published_at',
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
			'state' => WatchStatesEnum::class,
			'values_web' => AsCollection::class,
			'published_at' => 'date:Y-m-d h:i:s',
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
			->generateSlugsFrom('name')
			->skipGenerateWhen(fn () => ($this->state->color() != 'blue'));
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function type()
	{
		return $this->belongsTo(Type::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function collection()
	{
		return $this->belongsTo(Collection::class);
	}

	public function scopePublished($query)
	{
		$query->where('state', WatchStatesEnum::Published);
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
