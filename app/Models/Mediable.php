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
		'type',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function registerMediaCollections(): void
	{
		$this
			->addMediaCollection('photos');

		$this
			->addMediaCollection('logo')
			->singleFile();

		foreach (range(1, 5) as $key) {
			$this->addMediaCollection('photos_presentation_'.$key)
				->singleFile();
		}

		foreach (range(1, 5) as $key) {
			$this->addMediaCollection('photos_team_'.$key)
				->singleFile();
		}
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

		$this->addMediaConversion('optimized')
			->performOnCollections(
				'photos_presentation_1',
				'photos_presentation_2',
				'photos_presentation_3',
				'photos_presentation_4',
				'photos_presentation_5',
				'photos_team_1',
				'photos_team_2',
				'photos_team_3',
				'photos_team_4',
				'photos_team_5'
			)
			->width(800)
			->height(800);
	}
}
