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
		Schema::create('bracelet_stitching_color_watch', function (Blueprint $table) {
			$table->foreignId('bracelet_stitching_color_id')
			->comment('Reference to bracelet_stitching_color_id')
			->constrained(indexName: 'bscw_color_id_foreign')
			->cascadeOnDelete();
			$table->foreignId('watch_id')->constrained()->cascadeOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('bracelet_stitching_watch');
	}
};
