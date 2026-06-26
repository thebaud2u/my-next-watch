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
		'name',
		'slug'
	];

	// Relations
	public function brands(): HasMany
	{
		return $this->hasMany(Brand::class);
	}

	public function movements(): HasMany
	{
		return $this->hasMany(Movement::class);
	}
}
