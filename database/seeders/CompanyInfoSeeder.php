<?php

namespace Database\Seeders;

use App\Models\CompanyInfo;
use Illuminate\Database\Seeder;

class CompanyInfoSeeder extends Seeder
{
	protected $company = [
		[
			"id" => 1,
			"name" => "Ralka Jewelry",
			"phone1" => "+62 813 3118 2510",
			"email" => "ralkajewelry@gmail.com",
			"address" => "Jl. Kayoon, Surabaya, Indonesia",
			"login_background" => "img/bg-login.jpg"
		],
	];
	public function run()
	{
		foreach ($this->company as $data) {
			CompanyInfo::updateOrCreate(['id' => $data['id']], $data);
		}
	}
}
