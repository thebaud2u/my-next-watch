<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\InformationStatus;

use App\Models\Admin;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movements', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('brand_id')->nullable();
			$table->string('name', 255);
			$table->enum('type', ['quartz', 'solar', 'automatic', 'manual']);
			$table->tinyInteger('power_reserve')->nullable();
			$table->boolean('COSC')->default(false);
			$table->boolean('METAS')->default(false);
			$table->boolean('manufactured_caliber')->default(false);
			$table->text('description')->nullable();
			$table->string('nationality', 255);
			$table->unsignedTinyInteger('status')->default(InformationStatus::Draft->value);
			$table->unsignedBigInteger('admin_id')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
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
		Schema::dropIfExists('movements');
	}
};
