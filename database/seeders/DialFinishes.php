<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\DialFinish;

class DialFinishes extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$dialFinishes = [
			'sunburst',
			'guilloché',
			'clous de Paris',
			'grainé',
			'frosted',
			'sandblasted',
			'brushed',
			'satin',
			'matte',
			'glossy',
			'lacquered',
			'enamel',
			'hammered',
			'linen',
			'waffle',
			'honeycomb',
			'carbon Fiber',
			'meteorite',
			'mother-of-Pearl',
			'stone',
			'aventurine',
			'opaline',
			'fumé',
			'textured'
		];

		foreach($dialFinishes as $dialFinish) {
			$newDialFinish = new DialFinish;
			$newDialFinish->name = $dialFinish;
			$newDialFinish->admin_id = $admin->id;
			$newDialFinish->save();
		}
	}
}
