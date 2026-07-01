<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\DialColor;

class DialColors extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$dialColors = ['black', 'sunburst', 'white', 'gold', 'red', 'green', 'yellow', 'purple', 'blue'];

		foreach($dialColors as $dialColor) {
			$newDialColor = new DialColor;
			$newDialColor->name = $dialColor;
			$newDialColor->admin_id = $admin->id;
			$newDialColor->save();
		}
	}
}
