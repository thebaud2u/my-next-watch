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
		Schema::create('watches', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('collection_id')->nullable();
			$table->unsignedBigInteger('movement_id')->nullable();
			$table->string('slug');
			$table->string('name', 255);
			$table->string('reference', 255);
			$table->text('description')->nullable();
			$table->json('bezel')->default(json_encode([
				'color'=> null,
				'direction' => 'unidirectional',
				'material'=> null
			]));
			$table->json('bracelet')->default(json_encode([
				'style'=> null,
				'clasp' => null,
				'material'=> null
			]));
			$table->json('case')->default(json_encode([
				'diameter' => null,
				'lug-to-lug' => null,
				'lug width' => null,
				'thickness' => null,
				'waterproofness' => null,
				'material' => null
			]));
			$table->json('crown')->default(json_encode([
				'material'=> null,
				'screwed down' => true,
				'detail'=> null
			]));
			$table->json('crystal')->default(json_encode([
				'material'=> null,
				'domed' => true,
			]));
			$table->json('dial')->default(json_encode([
				'color' => null,
				'domed' => false,
				'textured' => false
			]));
			$table->json('function')->nullable();
			$table->double('release_price');
			$table->double('current_price')->nullable();
			$table->unsignedTinyInteger('status')->default(InformationStatus::Draft->value);
			$table->timestamp('published_at')->nullable();
			$table->unsignedBigInteger('admin_id')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('collection_id')->references('id')->on('collections')->onDelete('set null');
			$table->foreign('movement_id')->references('id')->on('movements')->onDelete('set null');
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
		Schema::dropIfExists('watches');
	}
};
