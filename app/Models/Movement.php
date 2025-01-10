<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Enums\InformationStatus;

class Movement extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'id',
		'brand_id',
		'name',
		'type',
		'COSC',
		'manufactured_caliber',
		'description',
		'nationality',
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
			'state' => InformationStatus::class,
			'created_at' => 'date:Y-m-d h:i:s',
			'updated_at' => 'date:Y-m-d h:i:s',
			'deleted_at' => 'datetime'
		];
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function admin()
	{
		return $this->belongsTo(Admin::class);
	}
}
