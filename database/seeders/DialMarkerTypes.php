<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\DialMarkerType;

class DialMarkerTypes extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$dialMarkerTypes = ['indexes', 'numerals', 'arabic'];

		foreach($dialMarkerTypes as $dialMarkerType) {
			$newDialMarkerType = new DialMarkerType;
			$newDialMarkerType->name = $dialMarkerType;
			$newDialMarkerType->admin_id = $admin->id;
			$newDialMarkerType->save();
		}
	}
}
