<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletMicroAdjustementSystem;

class BraceletMicroAdjustementSystems extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$braceletMicroAdjustmeentSystems = ['"t-fit"', 'classic'];

		foreach($braceletMicroAdjustmeentSystems as $braceletMicroAdjustmeentSystem) {
			$newBraceletMicroAdjustmeentSystem = new BraceletMicroAdjustementSystem;
			$newBraceletMicroAdjustmeentSystem->name = $braceletMicroAdjustmeentSystem;
			$newBraceletMicroAdjustmeentSystem->admin_id = $admin->id;
			$newBraceletMicroAdjustmeentSystem->save();
		}
	}
}
