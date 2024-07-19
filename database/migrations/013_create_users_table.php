<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('title_id')->nullable();
			$table->unsignedBigInteger('gender_id')->nullable();
			$table->string('slug');
			$table->string('nickname');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('email')->unique();
			$table->timestamp('last_logon')->nullable();
			$table->date('birth_date')->nullable();
			$table->text('other')->nullable();
			$table->string('phone')->nullable();
			$table->string('mobile_phone')->nullable();
			$table->json('values')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('title_id')->references('id')->on('titles')->onDelete('set null');
			$table->foreign('gender_id')->references('id')->on('genders')->onDelete('set null');
		});

		$newUser = new User;
		$newUser->title_id = 2;
		$newUser->gender_id = 2;
		$newUser->nickname = 'TheCreator';
		$newUser->first_name = 'Jean-Clement';
		$newUser->last_name = 'Thebaud';
		$newUser->email = 'thebaud.clement@gmail.com';
		$newUser->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
};
