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
			'Bridge' => 'A structural component that supports and secures the movement\'s gear train and other mechanisms while contributing to its overall rigidity and aesthetics.',
			'Main Plate' => 'The foundation of the movement, serving as the base on which all major components, bridges, and wheels are mounted.',
			'Rotor' => 'A semi-circular oscillating weight that rotates with the wearer\'s wrist movements to automatically wind the mainspring.',
			'Wheels' => 'Precision-engineered gears that transmit power throughout the movement, ensuring accurate timekeeping and efficient energy transfer.',
			'Screws' => 'Precision fasteners used to securely assemble movement components while often serving as decorative elements through fine finishing techniques.',
			'Edges' => 'The visible borders of movement components, often hand-finished with beveling and polishing to demonstrate exceptional craftsmanship.',
			'Steel Parts' => 'Various movement components made of steel, valued for their strength, durability, and suitability for high-end decorative finishing.',
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
