<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Experience extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	// Relations
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class);
	}
}
