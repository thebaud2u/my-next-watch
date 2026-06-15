

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class Users extends Seeder
{
	public function run(): void
	{
		$newUser = new User;
		$newUser->gender_id = 'Mr';
		$newUser->nickname = 'TheCreator';
		$newUser->first_name = 'Test';
		$newUser->last_name = 'User';
		$newUser->email = 'thebaud.clement@gmail.com';
		$newUser->experience_id = 2;
		$newUser->save();
	}
}
