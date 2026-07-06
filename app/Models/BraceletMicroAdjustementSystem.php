<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BraceletMicroAdjustementSystem extends Model
{
	use HasSlug, SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
		'state',
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
			->generateSlugsFrom('name');
	}

	// Relations
	public function admin(): BelongsTo
	{
		return $this->belongsTo(Admin::class);
	}

	public function watches(): HasMany
	{
		return $this->hasMany(Watch::class);
	}
}
