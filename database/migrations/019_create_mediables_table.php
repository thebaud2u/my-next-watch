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
		Schema::create('mediables', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->unsignedBigInteger('admin_id')->nullable();
			$table->string('type');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mediables', function (Blueprint $table) {
			$table->dropForeign(['user_id', 'admin_id']);
		});
		Schema::dropIfExists('mediable');
	}
};
