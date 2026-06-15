<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'country_id'
	];

	// Relations
	public function country(): BelongsTo
	{
		return $this->belongsTo(Country::class);
	}

	public function model(): MorphTo
	{
		return $this->morphTo();
	}
}
