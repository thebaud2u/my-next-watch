<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\InformationStatus;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletClaspColor;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bracelet_clasp_colors', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->unsignedTinyInteger('status')->default(InformationStatus::Draft->value);
			$table->unsignedBigInteger('admin_id')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
		});

		$admin = Admin::first();
		$colors = ['black', 'steel'];

		foreach($colors as $color) {
			$newClaspColor = new BraceletClaspColor;
			$newClaspColor->name = $color;
			$newClaspColor->admin_id = $admin->id;
			$newClaspColor->save();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('bracelet_clasp_colors');
	}
};
