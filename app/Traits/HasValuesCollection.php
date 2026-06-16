<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait HasValuesCollection
{
	public function updateValue(string $key, $value): void
	{
		$array = $this->values->toArray();

		// Séparation des segments : ex. "foo.bar.baz"
		$segments = explode('.', $key);
		$current = &$array;

		foreach($segments as $i => $segment) {
			if($i === count($segments) - 1) {
				// Dernier segment = on assigne
				$current[$segment] = $value;
			} else {
				// Si la clé n'existe pas ou est un scalaire, on la convertit en array
				if(!isset($current[$segment]) || !is_array($current[$segment])) {
					$current[$segment] = [];
				}
				$current = &$current[$segment]; // Référence pour descendre d’un niveau
			}
		}

		$this->values = collect($array);
	}

	public function removeValue(string $key): void
	{
		$values = $this->values;
		$values->forget($key);
		$this->values = $values;
	}

	public function removeValues(array $keys): void
	{
		$values = $this->values;
		foreach($keys as $key) {
			$values->forget($key);
		}
		$this->values = $values;
	}
}
