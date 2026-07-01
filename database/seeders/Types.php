<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Admin, Type};

class Types extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$types = ['dress watch', 'diver', 'military', 'racing watch', 'sport watch', 'field watch', 'aviation watch'];

		foreach($types as $type) {
			$newType = new Type;
			$newType->name = $type;
			$newType->admin_id = $admin->id;
			$newType->save();
		}
	}
}
