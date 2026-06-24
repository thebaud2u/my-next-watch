<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

use App\Enums\InformationStatus;

class Movement extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'brand_id',
		'name',
		'type',
		'COSC',
		'METAS',
		'manufactured_caliber',
		'description',
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
			'COSC' => 'boolean',
			'METAS' => 'boolean',
			'manufactured_caliber' => 'boolean',
			'status' => InformationStatus::class,
			'created_at' => 'datetime',
			'updated_at' => 'datetime',
			'deleted_at' => 'datetime'
		];
	}

	// Relations
	public function address(): MorphOne
	{
		return $this->morphOne(Address::class, 'model');
	}

	public function admin(): BelongsTo
	{
		return $this->belongsTo(Admin::class);
	}

	public function brand(): BelongsTo
	{
		return $this->belongsTo(Brand::class);
	}

	public function watches(): HasMany
	{
		return $this->hasMany(Watch::class);
	}
}
