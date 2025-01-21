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
			$table->json('bezel')->nullable();
			$table->json('bracelet')->nullable();
			$table->json('case')->nullable();
			$table->json('crown')->nullable();
			$table->json('crystal')->nullable();
			$table->json('dial')->nullable();
			$table->json('specification')->nullable();
			/*
				$table->json('bezel')->default(json_encode([
					'color'=> [],
					'direction' => 'unidirectional',
					'marking' => [],
					'material'=> []
				]));
				$table->json('bracelet')->default(json_encode([
					'clasp' => null,
					'clasp_color' => [],
					'clasp_material' => [],
					'material'=> [],
					'micro_adjustement' => true,
					'micro_adjustement_system' => 2,
					'stitching' => false,
					'stitching_color' => [],
					'style'=> null
				]));
				$table->json('case')->default(json_encode([
					'color' => [],
					'diameter' => null,
					'lug_to_lug' => null,
					'lug_width' => null,
					'material' => [],
					'open_case_back' => false,
					'sapphire_crystal_case_back' => false,
					'thickness' => null,
					'waterproofness' => null
				]));
				$table->json('crown')->default(json_encode([
					'color'=> [],
					'detail'=> null,
					'material'=> [],
					'screwed_down' => true
				]));
				$table->json('crystal')->default(json_encode([
					'domed' => true,
					'material'=> null
				]));
				$table->json('dial')->default(json_encode([
					'color' => [],
					'domed' => false,
					'marker_color' => [],
					'marker_lume' => true,
					'marker_lume_color' => [],
					'marker_type' => [],
					'textured' => false
				]));
				$table->json('specification')->default(json_encode([
					'complication' => [],
					'power_reserve' => null
				]));
			*/
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
