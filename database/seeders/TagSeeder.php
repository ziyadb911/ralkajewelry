<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    protected $tag = [
		[
			"id" => 1,
			"name" => "Cincin",
		],
		[
			"id" => 2,
			"name" => "Kalung",
		],
	];
	public function run()
	{
		foreach ($this->tag as $data) {
			Tag::updateOrCreate(['id' => $data['id']], $data);
		}
	}
}
