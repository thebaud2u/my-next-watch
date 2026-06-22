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
		Schema::create('collections', function(Blueprint $table) {
			$table->id();
			$table->foreignId('brand_id')->constrained()->cascadeOnDelete();
			$table->string('name', 255);
			$table->string('slug');
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
		Schema::dropIfExists('collections');
	}
};
