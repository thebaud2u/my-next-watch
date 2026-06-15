<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\Complication;

class Complications extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$complications = [
			'moon phase', 'GMT', 'power reserve indicator', 'tourbillon', 'small second', 'big date', 'chronograph',
			'flyback chronograph', 'double chronograph', 'calendar date', 'self-winding', 'annual calendar', 'perpetual calendar',
			'alarm'
		];

		foreach($complications as $complication) {
			$newComplication = new Complication;
			$newComplication->name = $complication;
			$newComplication->admin_id = $admin->id;
			$newComplication->save();
		}
	}
}
