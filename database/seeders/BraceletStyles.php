<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletStyle;

class BraceletStyles extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$braceletStyles = ['mesh', 'oyster', 'beads of rice', 'jubilee', 'expanding', 'tropic', 'classic'];

		foreach($braceletStyles as $braceletStyle) {
			$newBraceletStyle = new BraceletStyle;
			$newBraceletStyle->name = $braceletStyle;
			$newBraceletStyle->admin_id = $admin->id;
			$newBraceletStyle->save();
		}
	}
}
