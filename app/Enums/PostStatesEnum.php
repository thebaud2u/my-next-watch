<?php

namespace App\Enums;

enum WatchStatesEnum:int {
	case Draft = 1;
	case Published = 2;

	public function color(): string{
		return match($this) {
			self::Draft => 'blue',
			self::Published => 'green'
		};
	}
}
