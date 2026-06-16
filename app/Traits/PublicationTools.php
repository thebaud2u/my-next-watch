<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

use App\Enums\PublicationStates;

use App\Models\{ProfessionnalActivity, Post, Publication};

trait PublicationTools
{
	// Relations
	public function lastPublication(): MorphOne
	{
		return $this->morphOne(Publication::class, 'model')->latestOfMany();
	}
	
	public function publications(): MorphMany
	{
		return $this->morphMany(Publication::class, 'model');
	}

	// Functions
	public function isPublished(): bool
	{
		$lastPublication = $this->lastPublication;

		if($lastPublication) {
			$isPublished = ($lastPublication->isPublished() || $lastPublication->isPublishedUpdatedWaitingModeration());
			$hasBeenPublishedAtLeastOnce = $this->hasBeenPublished();

			return $isPublished && $hasBeenPublishedAtLeastOnce ? true: false;
		}
		else return false;
	}

	public function hasBeenPublished(): bool
	{
		return $this->countPublishedTimes() > 0 ? true: false;
	}

	public function countPublishedTimes(): int
	{
		return $this->publications()->where('state', PublicationStates::Published)->count();
	}

	public function isAvailable(): bool
	{
		return (!$this->lastPublication->isArchived() && !$this->lastPublication->isDeleted()) ? true : false;
	}

	public function sendPublicationEmail()
	{
		if($this instanceof ProfessionnalActivity) $type = 'professionnal-activity-validated';
		elseif($this instanceof Post) $type = 'post-validated';

		if($type) $this->user->sendAutomaticEmail($type, $this->id);
	}
}
