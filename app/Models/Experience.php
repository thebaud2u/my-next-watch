<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
	use HasSlug;

	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function users()
	{
		return $this->belongsToMany(User::class);
	}
}
