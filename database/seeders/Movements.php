<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Admin, Brand, Country, Movement, MovementType};

class Movements extends Seeder
{
	function getId(string $modelClass, string $name): int
	{
		return $modelClass::where('name', $name)->value('id') ?? throw new \RuntimeException("$modelClass not found : $name");
	}

	public function run(): void
	{
		$admin = Admin::first();

		$movements = [
			'Tudor' => [
				0 => [
					'name' => 'MT5602-U',
					'type' => 'automatic',
					'COSC' => false,
					'METAS' => true,
					'manufactured_caliber' => true,
					'antimagnetism' => 15000,
					'jewels' => 25,
					'frequency' => 28800,
					'country' => 'Suisse',
				],
				1 => [
					'name' => 'MT5602',
					'type' => 'automatic',
					'COSC' => true,
					'METAS' => false,
					'manufactured_caliber' => true,
					'antimagnetism' => null,
					'jewels' => 25,
					'frequency' => 28800,
					'country' => 'Suisse',
				]
			]
		];

		foreach($movements as $brand => $values) {
			foreach($values as $index => $movement) {
				$newMovement = new Movement;
				$newMovement->brand_id = $this->getId(Brand::class, $brand);
				$newMovement->country_id = $this->getId(Country::class, $movement['country']);
				$newMovement->movement_type_id = $this->getId(MovementType::class, $movement['type']);
				$newMovement->name = $movement['name'];
				$newMovement->COSC = $movement['COSC'];
				$newMovement->METAS = $movement['METAS'];
				$newMovement->manufactured_caliber = $movement['manufactured_caliber'];
				$newMovement->antimagnetism = $movement['antimagnetism'];
				$newMovement->jewels = $movement['jewels'];
				$newMovement->frequency = $movement['frequency'];
				$newMovement->admin_id = $admin->id;
				$newMovement->save();
			}
		}
	}
}
