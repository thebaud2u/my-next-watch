<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Admin, MovementPart};

class MovementParts extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$movementParts = [
			'Bridge' => 'blablabla',
			'Main Plate' => 'blablabla',
			'Rotor' => 'blablabla',
			'Wheels' => 'blablabla',
			'Screws' => 'blablabla',
			'Edges' => 'blablabla',
			'Steel Parts' => 'blablabla'
		];

		foreach($movementParts as $movementPart => $description) {
			$newMovementPart = new MovementPart;
			$newMovementPart->name = $movementPart;
			$newMovementPart->description = $description;
			$newMovementPart->admin_id = $admin->id;
			$newMovementPart->save();
		}
	}
}
