<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Notifications\ContactCreated;

class Contact extends Model
{
	use Notifiable;

	protected $fillable = [
		'object',
		'firstname',
		'lastname',
		'phone',
		'email',
		'body',
		'file',
		'created_at',
		'updated_at'
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	// Tools
	protected static function booted(): void
	{
		static::creating(function(Contact $contact) {
			$contact->notify(new ContactCreated($contact));
		});
	}
}
