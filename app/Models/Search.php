<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
			'filters' => 'collection',
			'email_alert' => 'boolean',
		];
	}

	// Tools
	protected static function booted(): void
	{
		static::creating(function(Search $search) {
			$search->uuid = (string) Str::uuid();
		});
	}

	// Relations
	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function postType(): BelongsTo
	{
		return $this->belongsTo(PostType::class);
	}

	public function thematic(): BelongsTo
	{
		return $this->belongsTo(Thematic::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
