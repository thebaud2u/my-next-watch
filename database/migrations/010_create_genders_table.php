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
			$table->string('name', 15);
			$table->string('title', 3)->nullable();
		});

		$data = [
			'Female' => 'Mrs',
			'Male' => 'Mr',
			'Nonbinary' => ''
		];

		foreach($data as $name => $title)
		{
			$newGender = new Gender;
			$newGender->name = $name;
			$newGender->title = $title;
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
