<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\CompanyInfo;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $company = CompanyInfo::findOrFail(1);
        $data = [
            'company' => $company,
        ];
        return view('home', $data);
    }

    public function artikel(Request $request)
    {
        $company = CompanyInfo::findOrFail(1);
        $articleCategories = ArticleCategory::orderBy("name", "ASC")->get();
        $tags = Tag::orderBy("name", "ASC")->get();
        $articles = Article::where("is_shown", true)->orderBy("created_at", "DESC")->get();
        $recentArticles = Article::where("is_shown", true)->orderBy("created_at", "DESC")->limit(4)->get();
        $data = [
            'company' => $company,
            'articleCategories' => $articleCategories,
            'tags' => $tags,
            'articles' => $articles,
            'recentArticles' => $recentArticles,
        ];
        return view('artikel', $data);
    }

    public function artikelDetail(Request $request)
    {
        $company = CompanyInfo::findOrFail(1);
        $recentArticles = Article::where("is_shown", true)->orderBy("created_at", "DESC")->limit(4)->get();
        $data = [
            'company' => $company,
            'recentArticles' => $recentArticles,
        ];
        return view('artikel-detail', $data);
    }
}
