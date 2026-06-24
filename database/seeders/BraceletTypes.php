<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletType;

class BraceletTypes extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$braceletTypes = [
			'bracelet', 'strap'
		];

		foreach($braceletTypes as $braceletType) {
			$newBraceletType = new BraceletType;
			$newBraceletType->name = $braceletType;
			$newBraceletType->admin_id = $admin->id;
			$newBraceletType->save();
		}
	}
}
