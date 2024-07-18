<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = [
		'id',
		'contact_choice',
		'firstname',
		'lastname',
		'phone',
		'email',
		'type_report',
		'reported',
		'body',
		'file'
	];

	/**
	 * The attributes that should be mutated to dates
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
	];
}
