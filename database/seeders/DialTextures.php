<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\DialTexture;

class DialTextures extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$dialTextures = [
			'Sunburst',
			'Guilloché',
			'Clous de Paris',
			'Grainé',
			'Frosted',
			'Sandblasted',
			'Brushed',
			'Satin',
			'Matte',
			'Glossy',
			'Lacquered',
			'Enamel',
			'Hammered',
			'Linen',
			'Waffle',
			'Honeycomb',
			'Carbon Fiber',
			'Meteorite',
			'Mother-of-Pearl',
			'Stone',
			'Aventurine',
			'Opaline',
			'Fumé'
		];

		foreach($dialTextures as $dialTexture) {
			$newDialTexture = new DialTexture;
			$newDialTexture->name = $dialTexture;
			$newDialTexture->admin_id = $admin->id;
			$newDialTexture->save();
		}
	}
}
