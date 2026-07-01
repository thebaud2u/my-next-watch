<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\CaseColor;

class CaseColors extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$caseColors = ['black', 'steel', 'gold', 'rose gold'];

		foreach($caseColors as $caseColor) {
			$newCaseColor = new CaseColor;
			$newCaseColor->name = $caseColor;
			$newCaseColor->admin_id = $admin->id;
			$newCaseColor->save();
		}
	}
}
