<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Complication extends Model
{
	use SoftDeletes;

	protected $fillable = [
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

	public function watches(): BelongsToMany
	{
		return $this->belongsToMany(Watch::class);
	}
}
