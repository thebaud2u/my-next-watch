<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Facades\CauserResolver;
use Spatie\Activitylog\Traits\LogsActivity;

class Admin extends Authenticatable
{
	use HasFactory, HasApiTokens, Notifiable, SoftDeletes, HasRoles, LogsActivity;

	/**
	 * Guard for the Admin model.
	 *
	 * @var string
	 */
	protected $guard = 'admin';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'first_name',
		'last_name',
		'job_title',
		'email',
		'deleted_at'
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token'
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * Set activity log options
	 *
	 * @see https://spatie.be/docs/laravel-activitylog/v4/api/log-options
	 *
	 * @return  \Spatie\Activitylog\LogOptions
	 */
	public function getActivitylogOptions(): LogOptions
	{
		CauserResolver::setCauser(Auth::guard('admin')->user());
		$by = (! empty(Auth::guard('admin')->user()->id) && Auth::guard('admin')->user()->id != $this->id) ? ' by Admin #:causer.id (:causer.email)' : '';

		return LogOptions::defaults()
			->useLogName('admin')
			->setDescriptionForEvent(fn(string $eventName) => 'Admin #:subject.id (:subject.email) has been '.$eventName.$by)
			->logAll()
			->logExcept(['remember_token', 'updated_at'])
			->dontLogIfAttributesChangedOnly(['remember_token', 'updated_at'])
			->logOnlyDirty();
	}
}
