<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\CrownMaterial;

class CrownMaterials extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$crownMaterials = ['stainless steel', 'aluminium', 'gold', 'rose gold', 'bronze', 'titanium', 'PVD-treated stainless steel'];

		foreach($crownMaterials as $crownMaterial) {
			$newCrownMaterial = new CrownMaterial;
			$newCrownMaterial->name = $crownMaterial;
			$newCrownMaterial->admin_id = $admin->id;
			$newCrownMaterial->save();
		}
	}
}
