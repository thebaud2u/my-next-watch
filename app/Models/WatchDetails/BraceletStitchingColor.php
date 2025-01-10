<?php

namespace App\Models\WatchDetails;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BraceletStitchingColor extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'id',
		'name',
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
			'created_at' => 'date:Y-m-d h:i:s',
			'updated_at' => 'date:Y-m-d h:i:s',
			'deleted_at' => 'datetime'
		];
	}

	public function admin()
	{
		return $this->belongsTo(Admin::class);
	}
}
