<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\DialMarkerLumeColor;

class DialMarkerLumeColors extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$dialMarkerLumeColors = ['green', 'blue'];

		foreach($dialMarkerLumeColors as $dialMarkerLumeColor) {
			$newDialMarkerLumeColor = new DialMarkerLumeColor;
			$newDialMarkerLumeColor->name = $dialMarkerLumeColor;
			$newDialMarkerLumeColor->admin_id = $admin->id;
			$newDialMarkerLumeColor->save();
		}
	}
}
