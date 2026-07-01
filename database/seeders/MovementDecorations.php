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
				'description' => 'blablabla'
			],
			'Perlage' => [
				'part' => 'Main Plate',
				'description' => 'blablabla'
			],
			'Anglage' => [
				'part' => 'Edges',
				'description' => 'blablabla'
			],
			'Black Polish' => [
				'part' => 'Steel Parts',
				'description' => 'blablabla'
			],
			'Heat-blued Screws' => [
				'part' => 'Screws',
				'description' => 'blablabla'
			],
			'Snailing' => [
				'part' => 'Wheels',
				'description' => 'blablabla'
			],
			'Skeletonized Rotor' => [
				'part' => 'Rotor',
				'description' => 'blablabla'
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
