@extends('admin.layouts.master')

@section('jsready')
    $('#formData').form({
        keyboardShortcuts: false,
        fields: {
            name: {
                identifier: 'name',
                rules: [{
                    type: 'empty',
                    prompt: 'Nama Tag tidak boleh kosong.'
                }, {
                    type: 'maxLength[100]',
                    prompt: 'Nama Tag maksimal 100 karakter.'
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
                showMessage("info", data.message, "{{ route('admin.tag') }}");
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
    <h2 class='ui dividing header'><i class='tags small icon'></i>{{ isset($tag) ? 'Ubah' : 'Tambah' }} Tag</h2>
    <a class='ui yellow button' href="{{ route('admin.tag') }}"><i class='left arrow icon'></i>Kembali</a>
    <br><br>
    <form class='ui form' method='POST' id='formData' action="{{ isset($tag) ? route('admin.tag.ubah.put',['tag' => $tag]) : route('admin.tag.tambah.post') }}">
        <div class='ui error message'></div>
        @csrf
        @isset($tag)
            @method('PUT')
        @endisset
        <div class='fields'>
            <div class='six wide required field'>
                <label>Nama Tag</label>
                <input type='text' name='name' id='name' placeholder='Nama Tag' autocomplete="off" value="{{ $tag->name ?? '' }}">
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
