@extends('admin.layouts.master')

@section('footer')
    <script src="{{ URL::asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <style>
        .ck-editor__editable {
            height: 12em;
        }
    </style>
@endsection

@section('jsready')
    $('#formData').form({
        keyboardShortcuts: false,
        fields: {
            title: {
                identifier: 'title',
                rules: [{
                    type: 'empty',
                    prompt: 'Judul tidak boleh kosong.'
                }, {
                    type: 'maxLength[200]',
                    prompt: 'Judul maksimal 200 karakter.'
                }]
            },
            article_category_id: {
                identifier: 'article_category_id',
                rules: [{
                    type: 'empty',
                    prompt: 'Kategori tidak boleh kosong.'
                }]
            },
            content: {
                identifier: 'content',
                rules: [{
                    type: 'empty',
                    prompt: 'Isi tidak boleh kosong.'
                }]
            },
        },
        onFailure: function (formErrors, fields) {
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
        }
    });

    $('#formData').submit(function (e) {
        e.preventDefault();
        if ($('#formData').form('is valid')){
            var frm = $(this);
            frm.addClass('loading');
            ajaxPost(this).done(function (data) {
                frm.removeClass('loading');
                showMessage("info", data.message, "{{ route('admin.artikel') }}");
            }).fail(function (data) {
                frm.removeClass('loading');
            })
        }
    });

    $(window).keydown(function(event){
        if(event.keyCode == 13 && !$(document.activeElement).is('textarea')) {
            event.preventDefault();
            return false;
        }
    });
@endsection

@section('jsfunction')
    var ckeditor;
    ClassicEditor.create(document.querySelector('#content'), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
    }).then(editor => {
        // membuat editor menjadi global biar bisa diakses
        ckeditor = editor;
    }).catch(error => {
        console.error(error);
    });
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='newspaper small icon'></i>{{ isset($article) ? 'Ubah' : 'Tambah' }} Artikel</h2>
    <a class='ui yellow button' href="{{ route('admin.artikel') }}"><i class='left arrow icon'></i>Kembali</a>
    <br><br>
    <form class='ui form' method='POST' id='formData' action="{{ isset($article) ? route('admin.artikel.ubah.put',['article' => $article]) : route('admin.artikel.tambah.post') }}">
        <div class='ui error message'></div>
        @csrf
        @isset($article)
            @method('PUT')
        @endisset
        <div class='fields'>
            <div class='ten wide required field'>
                <label>Judul</label>
                <input type='text' name='title' id='title' placeholder='Judul' autocomplete="off" value="{{ $article->title ?? '' }}">
            </div>
        </div>
        <div class='fields'>
            <div class='six wide required field'>
                <label>Kategori</label>
                <select class='ui search selection dropdown' name='article_category_id' id='article_category_id' required>
                    <option value="">Kategori</option>
                    @foreach ($articleCategories as $articleCategory)
                        <option value="{{ $articleCategory->id }}"{{ ($article->article_category_id ?? '') == $articleCategory->id ? ' selected' : '' }}>{{ $articleCategory->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class='fields'>
            <div class='six wide field'>
                <label>Tag</label>
                <select class='ui search selection dropdown' name='tags[]' id='tags' multiple>
                    <option value="">Tag</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"{{ $tag->selected ? ' selected' : '' }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class='fields'>
            <div class='sixteen wide required field'>
                <label>Isi</label>
                <textarea name="content" id="content" placeholder='isi konten artikel disini..' autocomplete="off">{{ $article->content ?? '' }}</textarea>
            </div>
        </div>
        <div class='fields'>
            <div class='field'>
                <button type='submit' class='ui green button'><i class='save icon'></i>Simpan</button>
            </div>
        </div>
    </form>
@endsection

@section('additional')
@endsection
