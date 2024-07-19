<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\WatchStatesEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('watches', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->unsignedBigInteger('type_id')->nullable();
			$table->unsignedBigInteger('brand_id')->nullable();
			$table->unsignedBigInteger('collection_id')->nullable();
			$table->string('slug');
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->json('characteristics');
			$table->unsignedTinyInteger('state')->default(WatchStatesEnum::Draft->value);
			$table->timestamp('published_at')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
			$table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
			$table->foreign('collection_id')->references('id')->on('collections')->onDelete('set null');
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
