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
		Schema::create('watches', function(Blueprint $table) {
			$table->id();
			$table->foreignId('collection_id')->constrained()->cascadeOnDelete();
			$table->foreignId('movement_id')->constrained()->cascadeOnDelete();
			$table->string('name', 255);
			$table->string('slug');
			$table->string('reference', 255);
			$table->text('description')->nullable();
			$table->json('bezel')->nullable();
			$table->json('bracelet')->nullable();
			$table->foreignId('bracelet_clasp_id')->nullable()->constrained()->cascadeOnDelete();
			$table->foreignId('bracelet_color_id')->nullable()->constrained()->cascadeOnDelete();
			$table->foreignId('bracelet_micro_adjustement_system_id')->nullable()->constrained()->cascadeOnDelete();
			$table->foreignId('bracelet_style_id')->nullable()->constrained()->cascadeOnDelete();
			$table->json('case')->nullable();
			$table->json('crown')->nullable();
			$table->json('crystal')->nullable();
			$table->json('dial')->nullable();
			$table->json('specification')->nullable();
			$table->double('release_price')->nullable();
			$table->double('current_price')->nullable();
			$table->string('state')->default(InformationStatus::Draft->value);
			$table->timestamp('published_at')->nullable();
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
		Schema::dropIfExists('watches');
	}
};
