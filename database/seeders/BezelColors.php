<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\BezelColor;

class BezelColors extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$bezelColors = ['burgundy', 'red', 'black', 'white', 'yellow', 'green', 'sunray', 'steel'];

		foreach($bezelColors as $bezelColor) {
			$newBezelColor = new BezelColor;
			$newBezelColor->name = $bezelColor;
			$newBezelColor->admin_id = $admin->id;
			$newBezelColor->save();
		}
	}
}
