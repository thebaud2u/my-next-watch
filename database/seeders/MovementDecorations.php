<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Admin, MovementDecoration, MovementPart};

class MovementDecorations extends Seeder
{
	protected function getId(string $model, string $name): int
	{
		return $model::where('name', $name)->value('id')
			?? throw new RuntimeException("$model not found: $name");
	}

	public function run(): void
	{
		$admin = Admin::first();

		$movementDecorations = [
			'Geneva Stripes' => [
				'part' => 'Bridge',
				'description' => 'A series of parallel decorative waves applied to movement bridges, enhancing visual appeal while showcasing traditional Swiss finishing.'
			],
			'Perlage' => [
				'part' => 'Main Plate',
				'description' => 'A decorative pattern of overlapping circular graining applied to the main plate, adding depth and refinement to the movement.'
			],
			'Anglage' => [
				'part' => 'Edges',
				'description' => 'The meticulous beveling and polishing of component edges by hand or machine, creating smooth reflective surfaces that demonstrate fine craftsmanship.'
			],
			'Black Polish' => [
				'part' => 'Steel Parts',
				'description' => 'An ultra-fine polishing technique that produces a mirror-like finish, appearing black from certain angles due to the way it reflects light.'
			],
			'Heat-blued Screws' => [
				'part' => 'Screws',
				'description' => 'Steel screws heated to a precise temperature to create a rich blue oxide layer, providing both corrosion resistance and an elegant finish.'
			],
			'Snailing' => [
				'part' => 'Wheels',
				'description' => 'A spiral decorative finish applied to wheels or ratchet components, creating concentric grooves that catch and reflect light beautifully.'
			],
			'Skeletonized Rotor' => [
				'part' => 'Rotor',
				'description' => 'A rotor with portions of its material removed to reveal more of the movement while maintaining efficient winding performance.'
			],
		];

		foreach($movementDecorations as $name => $values) {
			$newMovementDecoration = new MovementDecoration;

			$newMovementDecoration->movement_part_id = $this->getId(
				MovementPart::class,
				$values['part']
			);

			$newMovementDecoration->name = $name;
			$newMovementDecoration->description = $values['description'];
			$newMovementDecoration->admin_id = $admin->id;
			$newMovementDecoration->save();
		}
	}
}
