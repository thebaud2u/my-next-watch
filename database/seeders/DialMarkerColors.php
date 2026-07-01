<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\DialMarkerColor;

class DialMarkerColors extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$dialMarkerColors = ['gold', 'silver'];

		foreach($dialMarkerColors as $dialMarkerColor) {
			$newDialMarkerColor = new DialMarkerColor;
			$newDialMarkerColor->name = $dialMarkerColor;
			$newDialMarkerColor->admin_id = $admin->id;
			$newDialMarkerColor->save();
		}
	}
}
