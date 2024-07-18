<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function (Blueprint $table) {
			$table->id();
			$table->string('code');
			$table->string('name');
			$table->string('slug');
		});

		DB::table('countries')->truncate();

		LazyCollection::make(function () {
			$handle = fopen("database/migrations/csv/countries.csv", 'r');

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

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('countries');
	}
};
