<?php

namespace App\Models\WatchDetails;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Watch;

class BraceletStyle extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'bracelet_type_id',
		'name',
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

	// Relations
	public function admin(): BelongsTo
	{
		return $this->belongsTo(Admin::class);
	}

	public function type(): BelongsTo
	{
		return $this->belongsTo(BraceletType::class);
	}

	public function watches(): HasMany
	{
		return $this->hasMany(Watch::class);
	}
}
