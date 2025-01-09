<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\InformationStatus;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletMaterial;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bracelet_materials', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->unsignedTinyInteger('status')->default(InformationStatus::Draft->value);
			$table->unsignedBigInteger('admin_id')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
		});

		$materials = ['stainless steel', 'aluminium', 'rubber', 'ceramics', 'add', 'ostrich leather', 'crocodile skin',
			'lizard leather', 'shark leather', 'snake leather', 'cowhide', 'plastic', 'gold & steel',
			'gold', 'rose gold', 'alligator skin', 'gold plated', 'satin', 'silicone', 'textile', 'titanium'];

		foreach($materials as $material) {
			$newMaterial = new BraceletMaterial;
			$newMaterial->name = $material;
			$newMaterial->admin_id = Admin::first()->id;
			$newMaterial->save();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('bracelet_materials');
	}
};
