<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\CrystalMaterial;

class CrystalMaterials extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$crystalMaterials = ['sapphire', 'mineral', 'plexiglass', 'acrylic'];

		foreach($crystalMaterials as $crystalMaterial) {
			$newCrystalMaterial = new CrystalMaterial;
			$newCrystalMaterial->name = $crystalMaterial;
			$newCrystalMaterial->admin_id = $admin->id;
			$newCrystalMaterial->save();
		}
	}
}
