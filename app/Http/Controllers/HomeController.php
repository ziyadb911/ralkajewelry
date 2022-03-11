<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\CompanyInfo;
use App\Models\CustomerResponse;
use App\Models\Tag;
use DB;
use Exception;
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

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => ["required"],
            'phone' => ["required"],
            'email' => ["nullable"],
            'message' => ["nullable"],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'phone.required' => 'No. Handphone tidak boleh kosong.',
        ]);
        DB::beginTransaction();
        try {
            $article = CustomerResponse::create($validated);
            DB::commit();
            return response('OK', 200);
        } catch (Exception $e) {
            DB::rollback();
            return response('Terjadi kesalahan saat mengirim data, silahkan coba lagi', 500);
        }
    }
}
