<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use DB;
use Exception;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->judul;
        $article_category_id = $request->kategori;
        $created_at_min = $request->tglmin;
        $created_at_max = $request->tglmaks;
        $is_shown = $request->publish;
        $articles = Article::with(['articleCategory'])
            ->when(isset($title), function ($q) use ($title) {
                $q->where('title', 'LIKE', "%$title%");
            })->when(isset($article_category_id), function ($q) use ($article_category_id) {
                $q->where('article_category_id', $article_category_id);
            })->when(isset($created_at_min), function ($q) use ($created_at_min) {
                $q->whereDate('created_at', '>=', $created_at_min);
            })->when(isset($created_at_max), function ($q) use ($created_at_max) {
                $q->whereDate('created_at', '<=', $created_at_max);
            })->when(isset($is_shown), function ($q) use ($is_shown) {
                $q->where('is_shown', $is_shown);
            })
            ->orderBy("created_at", "DESC")->paginate($this->paginate);
        $articleCategories = ArticleCategory::orderBy("name", "ASC")->get();
        $data = array(
            "articles" => $articles,
            "articleCategories" => $articleCategories,
        );
        return view('admin.artikel.index', $data);
    }

    public function create()
    {
        return view('admin.artikel.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ["required", "max:100"],
        ], [
            'name.required' => 'Nama Tag tidak boleh kosong.',
            'name.max' => 'Nama Tag maksimal 100 karakter.',
        ]);
        DB::beginTransaction();
        try {
            $validated['created_by'] = auth()->id();
            $validated['updated_by'] = auth()->id();
            $article = Article::create($validated);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Artikel berhasil ditambahkan",
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Article $article)
    {
        $data = [
            'article' => $article
        ];
        return view('admin.artikel.lihat', $data);
    }

    public function edit(Article $article)
    {
        $data = [
            'article' => $article
        ];
        return view('admin.artikel.tambah', $data);
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'name' => ["required", "max:100"],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama maksimal 100 karakter.',
        ]);
        DB::beginTransaction();
        try {
            $validated['updated_by'] = auth()->id();
            $article->update($validated);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil diubah',
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Article $article)
    {
        DB::beginTransaction();
        try {
            $article->update([
                'updated_by' => auth()->id(),
                'deleted_by' => auth()->id(),
            ]);
            $article->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Artikel berhasil dihapus",
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
