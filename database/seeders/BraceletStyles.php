<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\WatchDetails\{BraceletStyle, BraceletType };

class BraceletStyles extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$data = [
			'bracelet' => [
				'mesh', 'oyster', 'beads of rice', 'jubilee', 'expanding', 'classic'
			],
			'strap' => [
				'classic', 'tropic', 'side stitched', 'two stitch'
			]
		];

		foreach($data as $braceletType => $braceletStyles) {
			foreach($braceletStyles as $braceletStyle) {
				$newBraceletStyle = new BraceletStyle;
				$newBraceletStyle->bracelet_type_id = BraceletType::where('name', $braceletType)->first()->id;
				$newBraceletStyle->name = $braceletStyle;
				$newBraceletStyle->admin_id = $admin->id;
				$newBraceletStyle->save();
			}
		}
	}
}
