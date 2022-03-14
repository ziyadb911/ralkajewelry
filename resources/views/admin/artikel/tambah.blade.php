@extends('admin.layouts.master')

@section('footer')
    <script src="{{ URL::asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('vendor/compressor/compressor.min.js') }}"></script>
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
            date: {
                identifier: 'date',
                rules: [{
                    type: 'empty',
                    prompt: 'Tanggal tidak boleh kosong.'
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

    $('#dtpDate').calendar({
        monthFirst: false,
        type: 'date',
        formatter: { date: dateformat },
        onChange: function (date, text) {
            var dt = formatDateValue(date);
            $('#date').val(dt);
        }
    });

    $('#formData').submit(function (e) {
        e.preventDefault();
        if ($('#formData').form('is valid')){
            $('#date').val(formatDateValue($('#dtpDate').calendar('get date')));
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

    $('#image_url').change(function (e) {		
		var jmlFoto = $('#imgPreview').find('.ui.image').length;
		var inputFile = $(this)[0];
		var files = inputFile.files;
		if (files.length > 0) {
			var uploadpath = inputFile.value;
			var fileExtension = uploadpath.substring(uploadpath.lastIndexOf(".") + 1, uploadpath.length).toLowerCase();
			if (fileExtension != "png" && fileExtension != "jpg" && fileExtension != "jpeg") {
				$(this).val("");
				showMessage('error', 'Foto harus berupa file gambar (.jpg / .jpeg / .png).');
				return;
			}
			if (files[0].size / 1024 / 1024 > 5) {
				$(this).val("");
				showMessage('error', 'File size tidak boleh melebihi 5 MB.');
				return;
			}
            console.log(files.length);
            $('#formData').addClass('loading');
			$.each(files, function (key, val) {
				compressImage(val).then(function (base64) {
					var fotobaru = `<div class='ui medium image rounded' >
                        <img src="${base64}" alt="image_url">
					</div>`;
					$('#imgPreview').html(fotobaru);
					$('#formData').removeClass('loading');
				}).catch(function (err) {
					$('#formData').removeClass('loading');
					console.log("ErrSelesai", err.message);
				});
			});
		}else{
            var fotobaru = `<div class='ui medium image rounded' >
                Tidak ada foto
            </div>`;
            $('#imgPreview').html(fotobaru);
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

    function compressImage(file) {
        return new Promise((resolve, reject) => {
            new Compressor(file, {
                quality: 0.8,
                maxHeight: 960,
                mimeType: 'jpeg',
                type: File,
                success(result) {
                    fileToBase64Promise(result).then(function (base64) {
                        console.log('selesai base64', base64);
                        resolve(base64);
                    }).catch(function (error) {
                        reject(error);
                    });
                },
                error(err) {
                    reject(err);
                    console.log("error", err.message);
                },
            });
        });
    }

    const fileToBase64Promise = (inputFile) => {
        const temporaryFileReader = new FileReader();

        return new Promise((resolve, reject) => {
            temporaryFileReader.onerror = () => {
                temporaryFileReader.abort();
                reject(new DOMException("Problem parsing input file."));
            };

            temporaryFileReader.onloadend = () => {
                resolve(temporaryFileReader.result);
            };
            temporaryFileReader.readAsDataURL(inputFile);
        });
    };
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='newspaper small icon'></i>{{ isset($article) ? 'Ubah' : 'Tambah' }} Artikel</h2>
    <a class='ui yellow button' href="{{ route('admin.artikel') }}"><i class='left arrow icon'></i>Kembali</a>
    <br><br>
    <form class='ui form' id='formData' method='POST' enctype="multipart/form-data" action="{{ isset($article) ? route('admin.artikel.ubah.post',['article' => $article]) : route('admin.artikel.tambah.post') }}">
        @csrf
        <div class='ui error message'></div>
        <div class='fields'>
            <div class='ten wide required field'>
                <label>Judul</label>
                <input type='text' name='title' id='title' placeholder='Judul' autocomplete="off" value="{{ $article->title ?? '' }}">
            </div>
        </div>
        <div class='fields'>
            <div class='ten wide field'>
                <label>Sub Judul</label>
                <input type='text' name='subtitle' id='subtitle' placeholder='Sub Judul' autocomplete="off" value="{{ $article->subtitle ?? '' }}">
            </div>
        </div>
        <div class="fields">
            <div class='four wide required field'>
                <label>Tanggal</label>
                <div class='ui calendar' id='dtpDate'>
                    <div class='ui input right icon'>
                        <input type='text' placeholder='Tanggal' autocomplete="off" value="{{ $article->date ?? today() }}">
                        <i class='calendar icon'></i>
                    </div>
                </div>
                <input type='hidden' name="date" id="date" value="{{ $article->date ?? today() }}"/>
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
            <div class='eight wide field'>
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
            <div class='five wide field'>
                <label>{{isset($article) ? 'Ganti' : ''}} Foto <span style="font-size: 8pt; font-weight: normal;">(Maks. 5MB)</span></label>
                <input type='file' class='ui button' name='image_url' id='image_url' accept='.png, .jpg, .jpeg'>
            </div>
        </div>
        <div class='ui medium images' id='imgPreview'>
            @if(isset($article))
                @if(isset($article->image_url))
                    <div class='ui medium image rounded'>
                        <img src="{{ URL::asset($article->image_url) }}" alt="{{ $article->image_url }}">
                    </div>
                @else
                    <div class='ui medium image rounded'>
                        Tidak ada foto
                    </div>
                @endif
            @endif
        </div>
        <div class='fields'>
            <div class='sixteen wide required field'>
                <label>Isi</label>
                <textarea name="content" id="content" placeholder='isi konten artikel disini..' autocomplete="off">{!! $article->content ?? '' !!}</textarea>
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
