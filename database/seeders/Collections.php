<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Admin, Brand, Collection};

class Collections extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$collections = [
			'Tudor' => [
				0 => [
					'name' => 'Black Bay'
				]
			]
		];

		foreach($collections as $brand => $values) {
			foreach($values as $index => $collection) {
				$newCollection = new Collection;
				$newCollection->brand_id = Brand::where('name', $brand)->first()->id;
				$newCollection->name = $collection['name'];
				$newCollection->admin_id = $admin->id;
				$newCollection->save();
			}
		}
	}
}
