<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Admin, MovementType};

class MovementTypes extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$movementTypes = [
			'quartz' => 'blablabla',
			'solar' => 'blablabla',
			'automatic' => 'blablabla',
			'manual' => 'blablabla'
		];

		foreach($movementTypes as $movementType => $description) {
			$newMovementType = new MovementType;
			$newMovementType->name = $movementType;
			$newMovementType->description = $description;
			$newMovementType->admin_id = $admin->id;
			$newMovementType->save();
		}
	}
}
