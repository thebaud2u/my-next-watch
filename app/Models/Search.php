<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Facades\CauserResolver;

class Search extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'uuid',
		'name',
		'user_id',
		'thematic_id',
		'post_type_id',
		'category_id',
		'filters',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'filters' => AsCollection::class,
		];
	}

	protected static function boot(): void
	{
		parent::boot();
		static::creating(function ($model) {
			$model->uuid = (string) Str::uuid();
		});
	}

	/**
	 * Set activity log options
	 *
	 * @return  \Spatie\Activitylog\LogOptions
	 */
	public function getActivitylogOptions(): LogOptions
	{
		CauserResolver::setCauser((empty(Auth::guard('admin')->user()->id)) ? ((empty(Auth::guard('web')->user())) ? null : Auth::guard('web')->user()) : Auth::guard('admin')->user());
		$by = (! empty(Auth::guard('admin')->user()->id)) ? ' by Admin #:causer.id (:causer.email)' : ((! empty(Auth::guard('web')->user()->id)) ? ' by User #:causer.id (:causer.email)' : ' by CLI/API');

		return LogOptions::defaults()
			->useLogName('search')
			->setDescriptionForEvent(fn(string $eventName) => 'Search #:subject.id (:subject.uuid) has been '.$eventName.$by)
			->logAll()
			->logOnlyDirty();
	}

	/**
	 * The "booted" method of the model.
	 */
	// protected static function booted(): void
	// {
	// 	static::addGlobalScope('enabled-thematic', function (Builder $builder) {
	// 		$builder->whereHas('thematic', function($whereHas) {
	// 			$whereHas->where('enabled', true);
	// 		});
	// 	});
	// }

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function thematic()
	{
		return $this->belongsTo(Thematic::class);
	}

	public function postType()
	{
		return $this->belongsTo(PostType::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
