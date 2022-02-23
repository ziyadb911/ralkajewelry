<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use DB;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->nama;
        $tags = Tag::when(isset($name), function ($q) use ($name) {
            $q->where('name', 'LIKE', "%$name%");
        })
            ->orderBy("name", "ASC")->paginate($this->paginate);
        $data = array(
            "tags" => $tags,
        );
        return view('admin.tag.index', $data);
    }

    public function create()
    {
        return view('admin.tag.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ["required", "max:100", "unique:App\Models\Tag,name,NULL,NULL,deleted_at,NULL"],
        ], [
            'name.required' => 'Nama Tag tidak boleh kosong.',
            'name.max' => 'Nama Tag maksimal 100 karakter.',
            'name.unique' => 'Nama Tag sudah digunakan.',
        ]);
        DB::beginTransaction();
        try {
            $tag = Tag::create($validated);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Tag \"$tag->name\" berhasil ditambahkan",
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Tag $tag)
    {
        $data = [
            'tag' => $tag
        ];
        return view('admin.tag.lihat', $data);
    }

    public function edit(Tag $tag)
    {
        $data = [
            'tag' => $tag
        ];
        return view('admin.tag.tambah', $data);
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => ["required", "max:100", "unique:App\Models\Tag,name,$tag->id,NULL,deleted_at,NULL"],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'name.unique' => 'Nama sudah digunakan.',
        ]);
        DB::beginTransaction();
        try {
            $tag->update($validated);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Tag berhasil diubah',
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Tag $tag)
    {
        DB::beginTransaction();
        try {
            $tag->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Tag \"$tag->name\" berhasil dihapus",
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
