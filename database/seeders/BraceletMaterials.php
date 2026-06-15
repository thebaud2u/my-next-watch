<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletMaterial;

class BraceletMaterials extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$braceletMaterials = ['stainless steel', 'aluminium', 'rubber', 'ceramics', 'add', 'ostrich leather', 'crocodile skin',
			'lizard leather', 'shark leather', 'snake leather', 'cowhide', 'plastic', 'gold & steel',
			'gold', 'rose gold', 'alligator skin', 'gold plated', 'satin', 'silicone', 'textile', 'titanium', 'hybrid leather'];

		foreach($braceletMaterials as $braceletMaterial) {
			$newBraceletMaterial = new BraceletMaterial;
			$newBraceletMaterial->name = $braceletMaterial;
			$newBraceletMaterial->admin_id = $admin->id;
			$newBraceletMaterial->save();
		}
	}
}
