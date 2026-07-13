<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\Experience;

class Experiences extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$experiences = [
			'Beginner' => 'I\'m a beginner in the watch world, help me find my perfect watch',
			'Regular' => 'I know quite a lot about watches, but I still got stuff to learn',
			'Professional' => 'Watches have no secrets for me'
		];

		foreach($experiences as $name => $description) {
			$newExperience = new Experience;
			$newExperience->name = $name;
			$newExperience->description = $description;
			$newExperience->admin_id = $admin->id;
			$newExperience->save();
		}
	}
}
