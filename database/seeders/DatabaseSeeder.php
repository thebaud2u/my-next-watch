<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$this->call([
			Admins::class,
			Countries::class,
			BraceletClasps::class,
			BraceletColors::class,
			BraceletMaterials::class,
			BraceletStyles::class,
			BraceletClaspMaterials::class,
			BraceletClaspColors::class,
			BraceletStitchingColors::class,
			BraceletMicroAdjustementSystems::class,
			CaseMaterials::class,
			CaseColors::class,
			BezelMaterials::class,
			BezelColors::class,
			BezelMarkings::class,
			CrownMaterials::class,
			CrownColors::class,
			CrystalMaterials::class,
			DialColors::class,
			DialMarkerColors::class,
			DialMarkerLumeColors::class,
			DialMarkerTypes::class,
			Complications::class,
			Brands::class,
			Collections::class,
			Movements::class,
			Types::class,
			Watches::class,
		]);
	}
}
