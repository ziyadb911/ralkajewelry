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
        $recentArticles = self::getRecentArticles(3);
        $data = [
            'company' => $company,
            'recentArticles' => $recentArticles,
        ];
        return view('home', $data);
    }

    public function artikel(Request $request)
    {
        $cari = $request->cari;
        $kategoriId = $request->kategori;
        $tagId = $request->tag;
        $company = CompanyInfo::findOrFail(1);
        $articleCategories = ArticleCategory::orderBy("name", "ASC")->get();
        $tags = Tag::orderBy("name", "ASC")->get();
        $recentArticles = self::getRecentArticles(4);

        // list artikel yg tampil dan di filter
        $articles = Article::when(isset($cari), function ($q) use ($cari) {
            $q->where('title', 'LIKE', "%$cari%");
        })->when(isset($kategoriId), function ($q) use ($kategoriId) {
            $q->where('article_category_id', $kategoriId);
        })->when(isset($tagId), function ($q) use ($tagId) {
            $q->whereHas('tags', function ($q) use ($tagId) {
                $q->where('id', $tagId);
            });
        })->where("is_shown", true)->orderBy("date", "DESC")->orderBy("created_at", "DESC")->paginate(4);

        $data = [
            'company' => $company,
            'recentArticles' => $recentArticles,
            'articleCategories' => $articleCategories,
            'tags' => $tags,
            'articles' => $articles,
        ];
        return view('artikel', $data);
    }

    public function artikelDetail(Request $request, Article $article)
    {
        if (!$article->is_shown) {
            abort(404);
        }
        $company = CompanyInfo::findOrFail(1);
        $recentArticles = self::getRecentArticles(4);
        $data = [
            'company' => $company,
            'recentArticles' => $recentArticles,
            'article' => $article,
        ];
        return view('artikel-detail', $data);
    }

    private function getRecentArticles(int $limit = 5)
    {
        return Article::where("is_shown", true)->orderBy("date", "DESC")->orderBy("created_at", "DESC")->limit($limit)->get();
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
            CustomerResponse::create($validated);
            DB::commit();
            return response('OK', 200);
        } catch (Exception $e) {
            DB::rollback();
            return response($e->getMessage(), 500);
        }
    }
}
