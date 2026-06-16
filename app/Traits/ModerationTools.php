<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

use App\Enums\ModerationStates;

use App\Models\Moderation;

trait ModerationTools
{
	// Relations
	public function lastModeration(): MorphOne
	{
		return $this->morphOne(Moderation::class, 'model')->latestOfMany();
	}

	public function moderations(): MorphMany
	{
		return $this->morphMany(Moderation::class, 'model');
	}

	// Functions
	public function awaitingModeration(): bool
	{
		$latestModeration = $this->lastModeration;
		
		return $latestModeration ? ($latestModeration->isWaiting() ? true : false) : false;
	}

	public function markForModeration(): void
	{
		if(!$this->awaitingModeration()) $this->moderations()->create();
	}

	public function getAwaitingModeration(): Moderation|null
	{
		return $this->moderations()->where('state', ModerationStates::Waiting)->first();
	}

	public function getValidatedModeration(): Moderation|null
	{
		return $this->lastModeration()->where('state', ModerationStates::Validated)->first();
	}

	public function hasBeenValidated(): bool
	{
		return $this->moderations()->where('state', ModerationStates::Validated)->exists();
	}
}
