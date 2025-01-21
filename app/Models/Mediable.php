<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Mediable extends Model implements HasMedia
{
	use HasFactory, InteractsWithMedia;

	protected $fillable = [
		'id',
		'user_id',
		'admin_id',
		'type',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function admin()
	{
		return $this->belongsTo(Admin::class);
	}

	public function registerMediaCollections(): void
	{
		$this
			->addMediaCollection('photos');

		$this
			->addMediaCollection('logo')
			->singleFile();
	}

	public function registerMediaConversions(Media $media = null): void
	{
		$this->addMediaConversion('optimized')
			->performOnCollections('photos')
			->width(1280)
			->height(1280);

		$this->addMediaConversion('optimized')
			->performOnCollections('logo')
			->width(360)
			->height(360);

		$this->addMediaConversion('optimized')
			->performOnCollections('bandeau')
			->width(1280)
			->height(1280);
	}
}
