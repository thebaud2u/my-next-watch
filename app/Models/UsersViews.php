<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersViews extends Model
{
	protected $fillable = [
		'user_id',
		'element_type',
		'element_id',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
