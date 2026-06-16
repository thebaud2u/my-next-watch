<?php

namespace App\Enums;

use App\Traits\AsHumanLabels;

enum FaqStates:string {
	use AsHumanLabels;

	case Draft = 'draft';
	case Published = 'published';

	public function inHuman(): string{
		return match($this) {
			self::Draft => 'draft',
			self::Published => 'published',
		};
	}
}
