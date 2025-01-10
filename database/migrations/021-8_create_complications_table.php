<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\InformationStatus;

use App\Models\Admin;
use App\Models\WatchDetails\Complication;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complications', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->unsignedTinyInteger('status')->default(InformationStatus::Draft->value);
			$table->unsignedBigInteger('admin_id')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
		});

		$admin = Admin::first();
		$complications = [
			'moon phase', 'GMT', 'power reserve indicator', 'tourbillon', 'small second', 'big date', 'chronograph',
			'flyback chronograph', 'double chronograph', 'calendar date', 'self-winding', 'annual calendar', 'perpetual calendar',
			'alarm'
		];

		foreach($complications as $complication) {
			$newComplication = new Complication;
			$newComplication->name = $complication;
			$newComplication->admin_id = $admin->id;
			$newComplication->save();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('complications');
	}
};
