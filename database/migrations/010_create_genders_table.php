<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Gender;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('genders', function (Blueprint $table) {
			$table->id();
			$table->string('name');
		});

		$data = [
			'Female',
			'Male',
			'Nonbinary'
		];

		foreach($data as $gender)
		{
			$newGender = new Gender;
			$newGender->name = $gender;
			$newGender->save();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('genders');
	}
};
