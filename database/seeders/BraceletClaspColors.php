<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletClaspColor;

class BraceletClaspColors extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$braceletClaspColors = ['black', 'steel'];

		foreach($braceletClaspColors as $braceletClaspColor) {
			$newBraceletClaspColor = new BraceletClaspColor;
			$newBraceletClaspColor->name = $braceletClaspColor;
			$newBraceletClaspColor->admin_id = $admin->id;
			$newBraceletClaspColor->save();
		}
	}
}
