<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
	protected $user = [
		[
			"id" => 1,
			"name" => "Developer",
			"username" => "developer",
			"email" => "developer@gmail.com",
			"password" => "password123",
		],
		[
			"id" => 2,
			"name" => "Rahmat",
			"username" => "rahmat",
			"email" => "rahmat@gmail.com",
			"password" => "password123",
		],
	];
	public function run()
	{
		foreach ($this->user as $data) {
			$data['password'] = Hash::make($data['password']);
			$data['email_verified_at'] = now();
			$data['remember_token'] = Str::random(10);
			User::updateOrCreate(['id' => $data['id']], $data);
		}
	}
}
