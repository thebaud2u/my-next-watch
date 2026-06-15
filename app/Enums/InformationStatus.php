<?php

namespace App\Enums;

use App\Traits\AsHumanLabels;

enum InformationStatus:string {
	use AsHumanLabels;

	case Archived = 'archived';
	case Deleted = 'deleted';
	case Draft = 'draft';
	case Published = 'published';

	public function inHuman(): string{
		return match($this) {
			self::Archived => 'Archived',
			self::Deleted => 'Deleted',
			self::Draft => 'Draft',
			self::Published => 'Published',
		};
	}
}