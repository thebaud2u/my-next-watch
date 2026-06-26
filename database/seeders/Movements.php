<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Admin, Brand, Country, Movement};

class Movements extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$movements = [
			'Tudor' => [
				0 => [
					'name' => 'MT5602-U',
					'type' => 'Automatic',
					'COSC' => false,
					'METAS' => true,
					'manufactured_caliber' => true,
					'country_code' => 'CHE',
				],
				1 => [
					'name' => 'MT5602',
					'type' => 'Automatic',
					'COSC' => true,
					'METAS' => false,
					'manufactured_caliber' => true,
					'country_code' => 'CHE',
				]
			]
		];

		foreach($movements as $brand => $values) {
			foreach($values as $index => $movement) {
				$country = Country::where('code', $movement['country_code'])
					->first();

				$newMovement = new Movement;
				$newMovement->brand_id = Brand::where('name', $brand)->first()->id;
				if($country) $newMovement->country_id = $country->id;
				$newMovement->name = $movement['name'];
				$newMovement->type = $movement['type'];
				$newMovement->COSC = $movement['COSC'];
				$newMovement->METAS = $movement['METAS'];
				$newMovement->manufactured_caliber = $movement['manufactured_caliber'];
				$newMovement->admin_id = $admin->id;
				$newMovement->save();
			}
		}
	}
}
