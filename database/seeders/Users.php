<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class Users extends Seeder
{
	public function run(): void
	{
		$newUser = new User;
		$newUser->gender = 'Mr';
		$newUser->first_name = 'Jean-Clément';
		$newUser->last_name = 'Thébaud';
		$newUser->nickname = 'M i s h a z a w a';
		$newUser->email = 'thebaud.clement@gmail.com';
		$newUser->password = Hash::make('2AHDlVklnpfSc0F1dJ3l');
		$newUser->experience_id = 2;
		$newUser->save();
	}
}
