<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('admin.tag.index');
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
        //
    }
}
