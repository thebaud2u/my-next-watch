<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Illuminate\Support\Facades\Auth;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Facades\CauserResolver;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Carbon\Carbon;

use App\Enums\PostStatesEnum;

use App\Models\PostModeration;

class Post extends Model implements Viewable, HasMedia
{
	use Favoriteable, HasSlug, InteractsWithMedia, InteractsWithViews, SoftDeletes;

	protected $fillable = [
		'id',
		'user_id',
		'thematic_id',
		'post_type_id',
		'category_id',
		'offer_id',
		'slug',
		'title',
		'body',
		'values_web',
		'values_print',
		'state',
		'parution_date',
		'published_at',
		'archived_at',
		'refreshed_at',
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
			'state' => PostStatesEnum::class,
			'values_web' => AsCollection::class,
			'values_print' => AsCollection::class,
			'batch' => 'datetime:Ymdhis',
			'parution_date' => 'date:Y-m-d',
			'published_at' => 'date:Y-m-d h:i:s',
			'archived_at' => 'date:Y-m-d h:i:s',
			'refreshed_at' => 'date:Y-m-d h:i:s',
			'deleted_at' => 'date:Y-m-d h:i:s'
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
			->useLogName('post')
			->setDescriptionForEvent(fn(string $eventName) => 'Post #:subject.id has been '.$eventName.$by)
			->logAll()
			->logOnlyDirty();
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
			->generateSlugsFrom('title')
			->usingLanguage('fr')
			->slugsShouldBeNoLongerThan(100)
			// No update when archived or published :
			->skipGenerateWhen(fn () => ($this->state > 2));
	}

	/**
	 * The "booted" method of the model.
	 */
	protected static function booted(): void
	{
		static::addGlobalScope('enabled-thematic', function (Builder $builder) {
			$builder->whereHas('thematic', function($whereHas) {
				$whereHas->where('enabled', true);
			});
		});
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function postType()
	{
		return $this->belongsTo(PostType::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function offer()
	{
		return $this->belongsTo(Offer::class);
	}

	public function thematic()
	{
		return $this->belongsTo(Thematic::class);
	}

	public function availabilities()
	{
		return $this->hasMany(Availability::class);
	}

	public function responses()
	{
		return $this->hasMany(Response::class);
	}

	public function publications()
	{
		return $this->hasMany(PostPublication::class);
	}

	public function address(): MorphOne
	{
		return $this->morphOne(Address::class, 'model');
	}

	public function addresses(): MorphMany
	{
		return $this->morphMany(Address::class, 'model');
	}

	public function moderations()
	{
		return $this->hasMany(PostModeration::class);
	}

	public function scopePublished($query)
	{
		$query->where('state', PostStatesEnum::Published);
	}

	public function options()
	{
		return $this->belongsToMany(
			Option::class,
			'posts_options',
			'post_id',
			'option_id'
		);
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

	public function latestModeration()
	{
		return $this->hasMany(PostModeration::class)->latest()->first();
	}

	public function isModerated()
	{
		if($this->latestModeration()) return __('Yes');
		else return __('No');
	}

	public function latestPublication()
	{
		return $this->hasMany(PostPublication::class)->latest()->first();
	}

	// Allows to detect if whether or not a post has a offer change pending
	public function hasOfferChangingPending()
	{
		$latestPublication = $this->latestPublication();

		if($latestPublication) {
			// If post offer is different than the offer of the latest publication
			// AND if the offer of the latest publication is not free
			if($this->offer != $latestPublication->offer) return true;
			else return false;
		}
		else return false;
	}

	public function isOfferChangePossible()
	{
		return $this->user->hasOfferSubscription($this->offer->slug);
	}

	public function hasOption($option)
	{
		return $this->options
			->where('code', $option)
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

	public function getParutionDate()
	{
		$dateParution = $this->__getNextDate($this->thematic);

		if($dateParution['status'] == 'Success') $dateParution = $dateParution['value'].' ('.__('magazine of :month', ['month' => __(Carbon::createFromFormat('d/m/Y', $dateParution['value'])->format('F'))]).')';
		else $dateParution = __('date temporarily unavailable');

		return $dateParution;
	}
}
