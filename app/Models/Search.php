<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Search extends Model
{
	use LogsActivity; // HasUuids, 

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
		'email_alert',
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
			'email_alert' => 'boolean',
		];
	}

	protected static function boot(): void
	{
		parent::boot();
		static::creating(function ($model) {
			$model->uuid = (string) Str::uuid();
		});
	}

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
