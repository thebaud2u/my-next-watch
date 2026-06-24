<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\{BraceletMaterial, BraceletType};

class BraceletMaterials extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$data = [
			'bracelet' => [
				'stainless steel', 'aluminium', 'ceramics', 'gold plated', 'gold & steel', 'gold', 'rose gold', 'titanium'
			],
			'strap' => [
				'rubber', 'add', 'ostrich leather', 'crocodile skin', 'lizard leather', 'shark leather', 'snake leather', 'cowhide', 'plastic', 'alligator skin', 'satin', 'silicone', 'textile', 'hybrid leather'
			]
		];

		foreach($data as $braceletType => $braceletMaterials) {
			foreach($braceletMaterials as $braceletMaterial) {
				$newBraceletMaterial = new BraceletMaterial;
				$newBraceletMaterial->bracelet_type_id = BraceletType::where('name', $braceletType)->first()->id;
				$newBraceletMaterial->name = $braceletMaterial;
				$newBraceletMaterial->admin_id = $admin->id;
				$newBraceletMaterial->save();
			}
		}
	}
}
