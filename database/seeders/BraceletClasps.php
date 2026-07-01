<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\BraceletClasp;

class BraceletClasps extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$braceletClasps = ['folding', 'single deployant', 'butterfly', 'triple deployant', 'ardillon buckle', 'sliding buckle', 'velcro'];

		foreach($braceletClasps as $braceletClasp) {
			$newBraceletClasp = new BraceletClasp;
			$newBraceletClasp->name = $braceletClasp;
			$newBraceletClasp->admin_id = $admin->id;
			$newBraceletClasp->save();
		}
	}
}
