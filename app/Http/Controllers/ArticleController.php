<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Tag;
use DB;
use Exception;
use File;
use Illuminate\Http\Request;
use Image;
use Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->judul;
        $article_category_id = $request->kategori;
        $created_at_min = $request->tglmin;
        $created_at_max = $request->tglmaks;
        $is_shown = $request->status;
        $tags = $request->tag;
        $articles = Article::with(['articleCategory', 'tags'])
            ->when(isset($title), function ($q) use ($title) {
                $q->where('title', 'LIKE', "%$title%");
            })->when(isset($article_category_id), function ($q) use ($article_category_id) {
                $q->where('article_category_id', $article_category_id);
            })->when(isset($tags), function ($q) use ($tags) {
                $q->where(function ($q) use ($tags) {
                    $q->whereHas('tags', function ($q) use ($tags) {
                        return $q->whereIn('id', array_values($tags));
                    });
                });
            })->when(isset($created_at_min), function ($q) use ($created_at_min) {
                $q->whereDate('created_at', '>=', $created_at_min);
            })->when(isset($created_at_max), function ($q) use ($created_at_max) {
                $q->whereDate('created_at', '<=', $created_at_max);
            })->when(isset($is_shown), function ($q) use ($is_shown) {
                $q->where('is_shown', $is_shown);
            })
            ->orderBy("created_at", "DESC")->paginate($this->paginate);
        $articleCategories = ArticleCategory::orderBy("name", "ASC")->get();
        $tags = Tag::orderBy("name", "ASC")->get();
        $data = array(
            "articles" => $articles,
            "tags" => $tags,
            "articleCategories" => $articleCategories,
        );
        return view('admin.artikel.index', $data);
    }

    public function create()
    {
        $articleCategories = ArticleCategory::orderBy("name", "ASC")->get();
        $tags = Tag::orderBy("name", "ASC")->get();
        $data = array(
            "articleCategories" => $articleCategories,
            "tags" => $tags,
        );
        return view('admin.artikel.tambah', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ["required", "max:200"],
            'article_category_id' => ["required", "exists:article_categories,id"],
            'content' => ["required"],
            'tags' => ["nullable", "array"],
            'tags.*' => ["exists:tags,id"],
        ], [
            'title.required' => 'Judul tidak boleh kosong.',
            'title.max' => 'Judul maksimal 200 karakter.',
            'article_category_id.required' => 'Kategori tidak boleh kosong.',
            'article_category_id.exists' => 'Kategori tidak tersedia.',
            'content.required' => 'Isi tidak boleh kosong.',
            'tags.array' => 'Tag tidak valid.',
            'tags.*.exists' => 'Tag id :attribute tidak tersedia.',
        ]);
        DB::beginTransaction();
        try {
            $slug = Str::slug($request->title);
            $count = Article::where('slug', 'RLIKE', "^{$slug}(-[0-9]+)?$")->count(); // check to see if any other slugs exist that are the same & count them
            $validated['slug'] = $count ? "{$slug}-{$count}" : $slug; // if other slugs exist that are the same, append the count to the slug
            $validated['is_shown'] = true;
            $validated['created_by'] = auth()->id();
            $validated['updated_by'] = auth()->id();
            $article = Article::create($validated);
            if(isset($request->tags)){
                $article->tags()->attach(array_values($request->tags));
            }
            if (isset($request->image_url)) {
                $path = 'img/artikel';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $namafoto = $article->slug . "-" . now()->format('Hisu') . '.jpg';
                $img = Image::make($request->image_url);
                $width = $img->width();
                $height = $img->height();
                $img = $img->encode('jpg', 100);
                if ($width > $height) {
                    if ($width > 1000) {
                        $img->resize(1000, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                } else {
                    if ($height > 1000) {
                        $img->resize(null, 1000, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                }

                $lokasisimpan = $path . "/" . $namafoto;
                $img->save($lokasisimpan);

                $article->image_url = $lokasisimpan;
                $article->save();
            }
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
        $articleCategories = ArticleCategory::orderBy("name", "ASC")->get();
        $tags = Tag::orderBy("name", "ASC")->get();
        foreach ($tags as $tag) {
            $tag->selected = in_array($tag->id, $article->tags->pluck('id')->toArray());
        }
        $data = array(
            'article' => $article,
            "articleCategories" => $articleCategories,
            "tags" => $tags,
        );
        return view('admin.artikel.tambah', $data);
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => ["required", "max:200"],
            'article_category_id' => ["required", "exists:article_categories,id"],
            'content' => ["required"],
            'tags' => ["nullable", "array"],
            'tags.*' => ["exists:tags,id"],
        ], [
            'title.required' => 'Judul tidak boleh kosong.',
            'title.max' => 'Judul maksimal 200 karakter.',
            'article_category_id.required' => 'Kategori tidak boleh kosong.',
            'article_category_id.exists' => 'Kategori tidak tersedia.',
            'content.required' => 'Isi tidak boleh kosong.',
            'tags.array' => 'Tag tidak valid.',
            'tags.*.exists' => 'Tag id :attribute tidak tersedia.',
        ]);
        DB::beginTransaction();
        try {
            $validated['updated_by'] = auth()->id();
            $article->update($validated);
            $article->tags()->detach();
            if(isset($request->tags)){
                $article->tags()->attach(array_values($request->tags));
            }
            if (isset($request->image_url)) {
                if (File::exists($article->image_url)) {
                    File::delete($article->image_url);
                }
                $path = 'img/artikel';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $namafoto = $article->slug . "-" . now()->format('Hisu') . '.jpg';
                $img = Image::make($request->image_url);
                $width = $img->width();
                $height = $img->height();
                $img = $img->encode('jpg', 100);
                if ($width > $height) {
                    if ($width > 1000) {
                        $img->resize(1000, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                } else {
                    if ($height > 1000) {
                        $img->resize(null, 1000, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                }

                $lokasisimpan = $path . "/" . $namafoto;
                $img->save($lokasisimpan);

                $article->image_url = $lokasisimpan;
                $article->save();
            }
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
            if(File::exists($article->image_url)){
                File::delete($article->image_url);
            }
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

    public function publish(Article $article)
    {
        DB::beginTransaction();
        try {
            $article->update([
                'is_shown' => !$article->is_shown,
                'updated_by' => auth()->id(),
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Artikel berhasil " . ($article->is_shown ? 'dipublish' : 'disembunyikan'),
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
