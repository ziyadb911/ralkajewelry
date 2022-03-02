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
