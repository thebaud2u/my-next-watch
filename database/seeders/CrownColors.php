<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\CrownColor;

class CrownColors extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$crownColors = ['black', 'steel', 'gold', 'rose gold'];

		foreach($crownColors as $crownColor) {
			$newCrownColor = new CrownColor;
			$newCrownColor->name = $crownColor;
			$newCrownColor->admin_id = $admin->id;
			$newCrownColor->save();
		}
	}
}
