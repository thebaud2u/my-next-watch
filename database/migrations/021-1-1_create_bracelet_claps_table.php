<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\InformationStatus;

use App\Models\Admin;
use App\Models\WatchDetails\BraceletClasp;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bracelet_clasps', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->unsignedTinyInteger('status')->default(InformationStatus::Draft->value);
			$table->unsignedBigInteger('admin_id')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
		});

		$clasps = ['folding', 'single deployant', 'butterfly', 'triple deployant', 'ardillon buckle', 'sliding buckle', 'velcro', '"t-fit"'];

		foreach($clasps as $clasp) {
			$newClasp = new BraceletClasp;
			$newClasp->name = $clasp;
			$newClasp->admin_id = Admin::first()->id;
			$newClasp->save();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('bracelet_clasps');
	}
};
