<?php

/** @see https://github.com/koenhendriks/laravel-str-acronym/blob/main/src/StrServiceProvider.php */

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class StrAcronymServiceProvider extends ServiceProvider
{
	public function boot()
	{
		Str::macro('acronym', function ($string, $delimiter = '') {
			if (empty($string)) {
				return '';
			}

			$acronym = '';
			foreach (preg_split('/[^\p{L}]+/u', $string) as $word) {
				if (! empty($word)){
					$first_letter = mb_substr($word, 0, 1);
					$acronym .= $first_letter . $delimiter;
				}
			}

			return $acronym;
		});

		Stringable::macro('acronym', function (string $delimiter = '') {
			return new Stringable(Str::acronym($this->value, $delimiter));
		});
	}
}
