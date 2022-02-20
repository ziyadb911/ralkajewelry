<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    protected $category = [
		[
			"id" => 1,
			"name" => "Umum",
		],
	];
	public function run()
	{
		foreach ($this->category as $data) {
			ArticleCategory::updateOrCreate(['id' => $data['id']], $data);
		}
	}
}
