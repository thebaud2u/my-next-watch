<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\CaseFinish;

class CaseFinishes extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$caseFinishes = [
			'polished',
			'brushed',
			'satin-brushed',
			'circular Brushed',
			'radial Brushed',
			'vertical Brushed',
			'horizontal Brushed',
			'mirror Polished',
			'bead-blasted',
			'sandblasted',
			'matte',
			'frosted',
			'hammered'
		];

		foreach($caseFinishes as $caseFinish) {
			$newCaseFinish = new CaseFinish;
			$newCaseFinish->name = $caseFinish;
			$newCaseFinish->admin_id = $admin->id;
			$newCaseFinish->save();
		}
	}
}
