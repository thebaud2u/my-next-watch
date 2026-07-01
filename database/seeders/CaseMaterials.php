<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\CaseMaterial;

class CaseMaterials extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$caseMaterials = ['stainless steel', 'aluminium', 'gold', 'rose gold', 'bronze', 'titanium', 'ceramic'];

		foreach($caseMaterials as $caseMaterial) {
			$newCaseMaterial = new CaseMaterial;
			$newCaseMaterial->name = $caseMaterial;
			$newCaseMaterial->admin_id = $admin->id;
			$newCaseMaterial->save();
		}
	}
}
