<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'thematic_id',
		'post_type_id',
		'type',
		'name'
	];

	public function thematic()
	{
		return $this->belongsTo(Thematic::class);
	}

	public function post_type()
	{
		return $this->belongsTo(PostType::class);
	}
}
