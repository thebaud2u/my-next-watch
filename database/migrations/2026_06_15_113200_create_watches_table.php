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
			$table->foreignId('collection_id')->constrained()->onDelete('cascade');
			$table->foreignId('movement_id')->constrained()->onDelete('cascade');
			$table->string('slug');
			$table->string('name', 255);
			$table->string('reference', 255);
			$table->text('description')->nullable();
			$table->json('bezel')->nullable();
			$table->json('bracelet')->nullable();
			$table->json('case')->nullable();
			$table->json('crown')->nullable();
			$table->json('crystal')->nullable();
			$table->json('dial')->nullable();
			$table->json('specification')->nullable();
			$table->double('release_price')->nullable();
			$table->double('current_price')->nullable();
			$table->boolean('completed')->default(false);
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
