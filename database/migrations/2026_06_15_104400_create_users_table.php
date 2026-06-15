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
		Schema::create('users', function(Blueprint $table) {
			$table->id();
			$table->enum('gender', ['Mr', 'Mrs', 'Non-binairy']);
			$table->string('slug');
			$table->string('nickname');
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->string('email')->unique();
			$table->string('password');
			$table->rememberToken();
			$table->date('birthday')->nullable();
			$table->string('phone')->nullable();
			$table->string('mobile')->nullable();
			$table->json('values')->nullable();
			$table->foreignId('experience_id')->nullable()->constrained()->onDelete('cascade');
			$table->timestamp('email_verified_at')->nullable();
			$table->timestamp('last_logon')->nullable();
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
		Schema::dropIfExists('users');
	}
};
