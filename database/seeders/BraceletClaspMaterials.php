<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletClaspMaterial;

class BraceletClaspMaterials extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$braceletClaspMaterials = ['stainless steel', 'PVD-treated stainless steel', 'titanium'];

		foreach($braceletClaspMaterials as $braceletClaspMaterial) {
			$newBraceletClaspMaterial = new BraceletClaspMaterial;
			$newBraceletClaspMaterial->name = $braceletClaspMaterial;
			$newBraceletClaspMaterial->admin_id = $admin->id;
			$newBraceletClaspMaterial->save();
		}
	}
}
