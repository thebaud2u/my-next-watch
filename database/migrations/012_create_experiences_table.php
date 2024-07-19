<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Experience;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('experiences', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('description');
		});

		$data = [
			'Beginner' => 'I\'m a beginner in the watch world, help me find my perfect watch',
			'Regular' => 'I know quite a lot about watches, but I still got stuff to learn',
			'Professional' => 'Watches have no secrets for me'
		];

		foreach($data as $name => $description) {
			$newExperience = new Experience;
			$newExperience->name = $name;
			$newExperience->description = $description;
			$newExperience->save();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('experiences');
	}
};
