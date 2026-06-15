<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\InformationStatus;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movements', function(Blueprint $table) {
			$table->id();
			$table->foreignId('brand_id')->constrained()->onDelete('cascade');
			$table->string('name', 255);
			$table->enum('type', ['quartz', 'solar', 'automatic', 'manual']);
			$table->tinyInteger('COSC')->default(0);
			$table->tinyInteger('METAS')->default(0);
			$table->tinyInteger('manufactured_caliber')->default(0);
			$table->text('description')->nullable();
			$table->string('state')->default(InformationStatus::Draft->value);
			$table->foreignId('admin_id')->constrained();
			$table->timestamps();
			$table->softDeletes();
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
