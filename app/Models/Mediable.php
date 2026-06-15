<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Mediable extends Model implements HasMedia
{
	use InteractsWithMedia;

	protected $fillable = [
		'user_id',
		'admin_id',
		'type',
	];

	// Tools
	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('avatar')->singleFile();
		$this->addMediaCollection('banner')->singleFile();
		$this->addMediaCollection('logo')->singleFile();
	}

	public function registerMediaConversions(?Media $media = null): void
	{
		$this->addMediaConversion('optimized')
			->performOnCollections('avatar')
			->width(1280)
			->height(1280);

		$this->addMediaConversion('optimized')
			->performOnCollections('logo')
			->width(360)
			->height(360);

		$this->addMediaConversion('optimized')
			->performOnCollections('banner')
			->width(1280)
			->height(1280);
	}

	// Relations
	public function admin(): BelongsTo
	{
		return $this->belongsTo(Admin::class);
	}
	
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
