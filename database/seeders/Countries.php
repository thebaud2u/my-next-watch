<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\Country;

class Countries extends Seeder
{
	public function run(): void
	{
		LazyCollection::make(function() {
			$handle = fopen("database/seeders/csv/countries.csv", 'r');

			while (($line = fgetcsv($handle, 4096)) !== false) {
				$dataString = implode(",", $line);
				$row = explode(',', $dataString);
				yield $row;
			}

			fclose($handle);
		})
		->skip(1)
		->chunk(200)
		->each(function (LazyCollection $chunk) {
			$records = $chunk->map(function ($row) {
				return [
					'name' => $row[0],
					'code' => $row[1],
					'slug' => Str::of($row[0])->slug('-'),
				];
			})->toArray();

			DB::table('countries')->insert($records);
		});
	}
}