<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\BraceletStitchingColor;

class BraceletStitchingColors extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$braceletStitchingColors = ['white', 'cream', 'blue'];

		foreach($braceletStitchingColors as $braceletStitchingColor) {
			$newBraceletStitchingColor = new BraceletStitchingColor;
			$newBraceletStitchingColor->name = $braceletStitchingColor;
			$newBraceletStitchingColor->admin_id = $admin->id;
			$newBraceletStitchingColor->save();
		}
	}
}
