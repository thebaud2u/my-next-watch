<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class Admins extends Seeder
{
	public function run(): void
	{
		$newAdmin = new Admin;
		$newAdmin->firstname = 'Jean-Clement';
		$newAdmin->lastname = 'Thebaud';
		$newAdmin->name = $newAdmin->firstname.' '.$newAdmin->lastname;
		$newAdmin->email = 'thebaud.clement@gmail.com';
		$newAdmin->password = Hash::make('KsL8aAffI4n0brGYEYZw');
		$newAdmin->save();
	}
}
