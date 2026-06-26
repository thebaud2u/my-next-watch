<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Admin, Brand, Country};

class Brands extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$brands = [
			0 => [
				'name' => 'Tudor',
				'description' => 'Tudor est une manufacture horlogère suisse de luxe, basée à Genève. Son nom a été déposé en 1926 par Hans Wilsdorf, créateur de Rolex. Les deux maisons horlogères sont détenues par la Fondation Hans Wilsdorf. Tudor s\'est initialement fait connaître pour ses montres de plongées destinées aux plongeurs militaires et professionnels. Les montres Tudor équipent notamment les Navy SEALs et la Marine Nationale française.',
				'country_code' => 'CHE',
				'external_link' => 'https://www.tudorwatch.com',
			]
		];

		foreach($brands as $brand => $value) {
			$country = Country::where('code', $value['country_code'])
				->first();

			$newBrand = new Brand;
			if($country) $newBrand->country_id = $country->id;
			$newBrand->name = $value['name'];
			$newBrand->description = $value['description'];
			$newBrand->external_link = $value['external_link'];
			$newBrand->admin_id = $admin->id;
			$newBrand->save();
		}
	}
}
