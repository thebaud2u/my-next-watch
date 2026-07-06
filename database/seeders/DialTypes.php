<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\DialType;

class DialTypes extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$dialTypes = [
			'solid',
			'open heart',
			'semi-skeleton',
			'skeletonized'
		];

		foreach($dialTypes as $dialType) {
			$newDialType = new DialType;
			$newDialType->name = $dialType;
			$newDialType->admin_id = $admin->id;
			$newDialType->save();
		}
	}
}
