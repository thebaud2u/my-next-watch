<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'code',
		'iso_code',
		'name',
		'slug'
	];

	public function regions(): HasMany
	{
		return $this->hasMany(Region::class, 'country_code', 'code');
	}
}
