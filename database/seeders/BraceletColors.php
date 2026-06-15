<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletColor;

class BraceletColors extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$braceletColors = ['steel', 'silver', 'beige', 'white', 'blue', 'burgundy', 'bronze', 'brown', 'grey', 'yellow', 'black', 'gold', 'gold & steel', 'orange', 'pink', 'red', 'green', 'purple'];

		foreach($braceletColors as $braceletColor) {
			$newBraceletColor = new BraceletColor;
			$newBraceletColor->name = $braceletColor;
			$newBraceletColor->admin_id = $admin->id;
			$newBraceletColor->save();
		}
	}
}
