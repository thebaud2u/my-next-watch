<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Experience extends Model
{
	use HasSlug;

	protected $fillable = [
		'name',
		'slug',
		'description',
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
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class);
	}
}
