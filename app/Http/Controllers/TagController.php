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
        ->orderBy("name", "asc")->paginate($this->paginate);
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
        //
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
        //
    }

    public function update(Request $request, Tag $tag)
    {
        //
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
