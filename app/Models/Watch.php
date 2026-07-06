<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use App\Enums\InformationStatus;

class Watch extends Model implements Viewable, HasMedia
{
	use HasSlug, InteractsWithMedia, InteractsWithViews, SoftDeletes;

	protected $fillable = [
		'bracelet_clasp_id',
		'bracelet_color_id',
		'bracelet_micro_adjustement_system_id',
		'bracelet_style_id',
		'collection_id',
		'dial_type_id',
		'movement_id',
		'name',
		'slug',
		'reference',
		'description',
		'bezel',
		'bracelet',
		'case',
		'crown',
		'crystal',
		'dial',
		'specificities',
		'release_price',
		'current_price',
		'state',
		'published_at',
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
			'bezel' => 'collection',
			'bracelet' => 'collection',
			'case' => 'collection',
			'crown' => 'collection',
			'crystal' => 'collection',
			'dial' => 'collection',
			'specificities' => 'collection',
			'release_price' => 'double',
			'current_price' => 'double',
			'status' => InformationStatus::class,
			'published_at' => 'datetime',
			'created_at' => 'datetime',
			'updated_at' => 'datetime',
			'deleted_at' => 'datetime'
		];
	}

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
			->generateSlugsFrom('reference');
	}

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('photos');
	}

	public function registerMediaConversions(?Media $media = null): void
	{
		$this->addMediaConversion('optimized')
			->performOnCollections('photos')
			->width(1280)
			->height(1280);
	}

	// Relations
	public function admin(): BelongsTo
	{
		return $this->belongsTo(Admin::class);
	}

	public function bezelColors(): BelongsToMany
	{
		return $this->belongsToMany(BezelColor::class);
	}

	public function bezelMarkings(): BelongsToMany
	{
		return $this->belongsToMany(BezelMarking::class);
	}

	public function bezelMaterials(): BelongsToMany
	{
		return $this->belongsToMany(BezelMaterial::class);
	}

	public function braceletClasp(): BelongsTo
	{
		return $this->belongsTo(BraceletClasp::class);
	}

	public function braceletClaspColors(): BelongsToMany
	{
		return $this->belongsToMany(BraceletClaspColor::class);
	}

	public function braceletClaspMaterials(): BelongsToMany
	{
		return $this->belongsToMany(BraceletClaspMaterial::class);
	}

	public function braceletColor(): BelongsTo
	{
		return $this->belongsTo(BraceletColor::class);
	}

	public function braceletMaterials(): BelongsToMany
	{
		return $this->belongsToMany(BraceletMaterial::class);
	}

	public function braceletMicroAdjustementSystem(): BelongsTo
	{
		return $this->belongsTo(BraceletMicroAdjustementSystem::class);
	}

	public function braceletStitchingColors(): BelongsToMany
	{
		return $this->belongsToMany(BraceletStitchingColor::class);
	}

	public function braceletStyle(): BelongsTo
	{
		return $this->belongsTo(BraceletStyle::class);
	}

	public function caseColors(): BelongsToMany
	{
		return $this->belongsToMany(CaseColor::class);
	}

	public function caseMaterials(): BelongsToMany
	{
		return $this->belongsToMany(CaseMaterial::class);
	}

	public function collection(): BelongsTo
	{
		return $this->belongsTo(Collection::class);
	}

	public function complications(): BelongsToMany
	{
		return $this->belongsToMany(Complication::class);
	}

	public function crownColors(): BelongsToMany
	{
		return $this->belongsToMany(CrownColor::class);
	}

	public function crownMaterials(): BelongsToMany
	{
		return $this->belongsToMany(CrownMaterial::class);
	}

	public function crystalMaterials(): BelongsToMany
	{
		return $this->belongsToMany(CrystalMaterial::class);
	}

	public function dialColors(): BelongsToMany
	{
		return $this->belongsToMany(DialColor::class);
	}

	public function dialMarkerColors(): BelongsToMany
	{
		return $this->belongsToMany(DialMarkerColor::class);
	}

	public function dialMarkerLumeColors(): BelongsToMany
	{
		return $this->belongsToMany(DialMarkerLumeColor::class);
	}

	public function dialMarkerTypes(): BelongsToMany
	{
		return $this->belongsToMany(DialMarkerType::class);
	}

	public function dialTextures(): BelongsToMany
	{
		return $this->belongsToMany(DialTexture::class);
	}

	public function dialType(): BelongsTo
	{
		return $this->belongsTo(DialType::class);
	}

	public function movement(): BelongsTo
	{
		return $this->belongsTo(Movement::class);
	}

	public function movementDecoration(): BelongsToMany
	{
		return $this->belongsToMany(MovementDecoration::class);
	}

	public function type(): BelongsTo
	{
		return $this->belongsTo(Type::class);
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

	function getBrand(): ?Brand
	{
		return $this->collection?->brand;
	}
}
