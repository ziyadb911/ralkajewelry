@extends('admin.layouts.master')

@section('jsready')
    $('#formData').form({
        keyboardShortcuts: false,
        fields: {
            name: {
                identifier: 'name',
                rules: [{
                    type: 'empty',
                    prompt: 'Nama Kategori Artikel tidak boleh kosong.'
                }, {
                    type: 'maxLength[100]',
                    prompt: 'Nama Kategori Artikel maksimal 100 karakter.'
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
                showMessage("info", data.message, "{{ route('admin.kategoriartikel') }}");
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
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='filter small icon'></i>{{ isset($articleCategory) ? 'Ubah' : 'Tambah' }} Kategori Artikel</h2>
    <a class='ui yellow button' href="{{ route('admin.kategoriartikel') }}"><i class='left arrow icon'></i>Kembali</a>
    <br><br>
    <form class='ui form' method='POST' id='formData' action="{{ isset($articleCategory) ? route('admin.kategoriartikel.ubah.put',['articleCategory' => $articleCategory]) : route('admin.kategoriartikel.tambah.post') }}">
        <div class='ui error message'></div>
        @csrf
        @isset($articleCategory)
            @method('PUT')
        @endisset
        <div class='fields'>
            <div class='six wide required field'>
                <label>Nama Kategori Artikel</label>
                <input type='text' name='name' id='name' placeholder='Nama Kategori Artikel' autocomplete="off" value="{{ $articleCategory->name ?? '' }}">
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
