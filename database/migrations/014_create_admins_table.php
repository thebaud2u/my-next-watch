<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
		Schema::create('admins', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email')->unique();
			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
		});

		$newAdmin = new Admin;
		$newAdmin->first_name = 'Jean-Clement';
		$newAdmin->last_name = 'Thebaud';
		$newAdmin->name = $newAdmin->first_name.' '.$newAdmin->last_name;
		$newAdmin->email = 'thebaud.clement@gmail.com';
		$newAdmin->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('admins');
	}
};
