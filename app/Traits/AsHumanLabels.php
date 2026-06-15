<?php

namespace App\Traits;

trait AsHumanLabels
{
	abstract public function inHuman(): string;

	public static function asHumanArray(): array
	{
		$cases = self::cases();

		if (method_exists(self::class, 'sortOrder')) {
			usort($cases, fn($a, $b) =>
				$a->sortOrder() <=> $b->sortOrder()
			);
		}

		return collect($cases)->mapWithKeys(fn($case) => [
			$case->value => $case->inHuman()
		])->toArray();
	}
}
