<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        return view('admin.kategori-artikel.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(ArticleCategory $articleCategory)
    {
        $data = [
            'articleCategory' => $articleCategory
        ];
        return view('admin.kategori-artikel.lihat', $data);
    }

    public function edit(ArticleCategory $articleCategory)
    {
        //
    }

    public function update(Request $request, ArticleCategory $articleCategory)
    {
        //
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        //
    }
}
