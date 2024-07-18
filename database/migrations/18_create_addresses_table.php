<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function (Blueprint $table) {
			$table->id();
			$table->morphs('model');
			$table->unsignedBigInteger('country_id')->nullable();
			$table->double('gps_lat', 16, 14)->nullable();
			$table->double('gps_lng', 17, 14)->nullable();

			$table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('addresses');
	}
};
