<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use DB;
use Exception;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->nama;
        $articleCategories = ArticleCategory::when(isset($name), function ($q) use ($name) {
            $q->where('name', 'LIKE', "%$name%");
        })
            ->orderBy("name", "ASC")->paginate($this->paginate);
        $data = array(
            "articleCategories" => $articleCategories,
        );
        return view('admin.kategori-artikel.index', $data);
    }

    public function create()
    {
        return view('admin.kategori-artikel.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ["required", "max:100", "unique:App\Models\ArticleCategory,name,NULL,NULL,deleted_at,NULL"],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'name.unique' => 'Nama sudah digunakan.',
        ]);
        DB::beginTransaction();
        try {
            $articleCategory = ArticleCategory::create($validated);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "ArticleCategory \"$articleCategory->name\" berhasil ditambahkan",
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
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
        $data = [
            'articleCategory' => $articleCategory
        ];
        return view('admin.kategori-artikel.tambah', $data);
    }

    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $validated = $request->validate([
            'name' => ["required", "max:100", "unique:App\Models\ArticleCategory,name,$articleCategory->id,NULL,deleted_at,NULL"],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'name.unique' => 'Nama sudah digunakan.',
        ]);
        DB::beginTransaction();
        try {
            $articleCategory->update($validated);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Kategori Artikel berhasil diubah',
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        DB::beginTransaction();
        try {
            $articleCategory->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Kategori Artikel \"$articleCategory->name\" berhasil dihapus",
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
