<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\BezelMaterial;

class BezelMaterials extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$bezelMaterials = ['stainless steel', 'PVD-treated stainless steel', 'aluminium', 'gold', 'rose gold', 'bronze', 'titanium', 'ceramic'];

		foreach($bezelMaterials as $bezelMaterial) {
			$newBezelMaterial = new BezelMaterial;
			$newBezelMaterial->name = $bezelMaterial;
			$newBezelMaterial->admin_id = $admin->id;
			$newBezelMaterial->save();
		}
	}
}
