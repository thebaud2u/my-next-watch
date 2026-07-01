<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\BezelMarking;

class BezelMarkings extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$bezelMarkings = ['engraved', 'numerals'];

		foreach($bezelMarkings as $bezelMarking) {
			$newBezelMarking = new BezelMarking;
			$newBezelMarking->name = $bezelMarking;
			$newBezelMarking->admin_id = $admin->id;
			$newBezelMarking->save();
		}
	}
}
