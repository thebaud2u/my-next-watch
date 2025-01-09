<?php

namespace App\Enums;

enum InformationStatus:int {
	case Draft = 1;
	case Published = 2;
	case Deleted = 3;

	public function color(): string{
		return match($this) {
			self::Draft => 'blue',
			self::Published => 'green',
			self::Deleted => 'red'
		};
	}
}
