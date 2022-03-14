@extends('admin.layouts.master')

@section('footer')
	<script src="{{ URL::asset('vendor/compressor/compressor.min.js') }}"></script>
@endsection

@section('jsready')
	$('#formInfoPerusahaan').form({
		fields: {
			name:{
				identifier: 'name',
				rules: [{
					type   : 'empty',
					prompt : 'Nama tidak boleh kosong'
				},{
					type   : 'minLength[2]',
					prompt : 'Nama minimal 2 karakter'
				},{
					type   : 'maxLength[100]',
					prompt : 'Nama maksimal 100 karakter'
				}]
			},
			phone1:{
				identifier: 'phone1',
				rules: [{
					type   : 'maxLength[20]',
					prompt : 'No.Telpon 1 maksimal 20 karakter'
				}]
			},
			phone2:{
				identifier: 'phone2',
				rules: [{
					type   : 'maxLength[20]',
					prompt : 'No.Telpon 2 maksimal 20 karakter'
				}]
			},
			email:{
				identifier: 'email',
				rules: [{
					type   : 'maxLength[100]',
					prompt : 'Email maksimal 100 karakter'
				}]
			},
			url:{
				identifier: 'url',
				rules: [{
					type   : 'maxLength[100]',
					prompt : 'Website URL maksimal 100 karakter'
				}]
			},
			wa:{
				identifier: 'wa',
				rules: [{
					type   : 'maxLength[100]',
					prompt : 'WhatsApp URL maksimal 100 karakter'
				}]
			},
			facebook:{
				identifier: 'facebook',
				rules: [{
					type   : 'maxLength[100]',
					prompt : 'Facebook URL maksimal 100 karakter'
				}]
			},
			instagram:{
				identifier: 'instagram',
				rules: [{
					type   : 'maxLength[100]',
					prompt : 'Instagram URL maksimal 100 karakter'
				}]
			},
			twitter:{
				identifier: 'twitter',
				rules: [{
					type   : 'maxLength[100]',
					prompt : 'Twitter URL maksimal 100 karakter'
				}]
			},
		}
	});

	$('#formInfoPerusahaan').submit(function(e){
        e.preventDefault();
        if($('#formInfoPerusahaan').form('is valid')){
            var frm = $(this);
            frm.addClass('loading');
			ajaxPost(this).done(function (data) {
                frm.removeClass('loading');
                showMessage("info", data.message, "{{ route('admin.infoperusahaan') }}");
            }).fail(function (data) {
                frm.removeClass('loading');
            })
        }
    });

	$('#login_background').change(function (e) {		
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
            $('#formInfoPerusahaan').addClass('loading');
			$.each(files, function (key, val) {
				compressImage(val).then(function (base64) {
					var fotobaru = `<div class='ui small image rounded' >
                        <img src="${base64}" alt="login_background">
					</div>`;
					$('#imgPreview').html(fotobaru);
					$('#formInfoPerusahaan').removeClass('loading');
				}).catch(function (err) {
					$('#formInfoPerusahaan').removeClass('loading');
					console.log("ErrSelesai", err.message);
				});
			});
		}else{
            var fotobaru = `<div class='ui small image rounded' >
                Tidak ada foto
            </div>`;
            $('#imgPreview').html(fotobaru);
        }
	});
@endsection

@section('jsfunction')
	function showModalConfirm(){
		$('#formInfoPerusahaan').form('validate form');
		if($('#formInfoPerusahaan').form('is valid')){
			$("#modalConfirm").modal("show");
		}
	}
	
	function submitForm(){
		$("#formInfoPerusahaan").submit();
	}

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
	<h2 class='ui dividing header'><i class='building small icon'></i>Informasi Perusahaan</h2>
	<form class="ui form" enctype="multipart/form-data" action="{{ route('admin.infoperusahaan.post') }}" method="POST" id='formInfoPerusahaan'>
		@csrf
		<div class='ui error message'></div>
		<div class='ui grid'>
			<div class='eight wide computer sixteen wide mobile column'>
				<div class="ui segment">
					<h3>Kontak Perusahaan</h3>
					<div class="required field">
						<label>Nama Perusahaan</label>
						<input type="text" name="name" id='name' placeholder="Nama Perusahaan" autocomplete="off" value="{{ $company->name ?? '' }}">
					</div>
					<div class="field">
						<label>No. Telpon 1</label>
						<input type='text' name='phone1' id='phone1' placeholder="No. Telpon 1" autocomplete="off" value="{{ $company->phone1 ?? '' }}">
					</div>
					<div class="field">
						<label>No. Telpon 2</label>
						<input type='text' name='phone2' id='phone2' placeholder="No. Telpon 2" autocomplete="off" value="{{ $company->phone2 ?? '' }}">
					</div>
					<div class="field">
						<label>Email</label>
						<input type='email' name='email' id='email' placeholder="Email" autocomplete="off" value="{{ $company->email ?? '' }}">
					</div>
					<div class="field">
						<label>Website URL</label>
						<input type='text' name='url' id='url' placeholder="Website URL" autocomplete="off" value="{{ $company->url ?? '' }}">
					</div>
					<div class="field">
						<label>Alamat</label>
						<textarea name="address" id="address" rows="2" placeholder="Alamat" autocomplete="off">{{ $company->address ?? '' }}</textarea>
					</div>
				</div>
				<div class="ui segment">
					<h3>Teks Halaman Umum</h3>
					<div class="field">
						<label>Kata Menarik</label>
						<textarea name="invitation_text" id="invitation_text" rows="2" placeholder="Kata Menarik" autocomplete="off">{{ $company->invitation_text ?? '' }}</textarea>
					</div>
				</div>
			</div>
			<div class='eight wide computer sixteen wide mobile column'>
				<div class="ui segment">
					<h3>Social Media</h3>
					<div class="field">
						<label>WhatsApp</label>
						<input type='text' name='wa' id='wa' placeholder="WhatsApp" autocomplete="off" value="{{ $company->wa ?? '' }}">
					</div>
					<div class="field">
						<label>Facebook</label>
						<input type="text" name="facebook" id='facebook' placeholder="Facebook" autocomplete="off" value="{{ $company->facebook ?? '' }}">
					</div>
					<div class="field">
						<label>Instagram</label>
						<input type='text' name='instagram' id='instagram' placeholder="Instagram" autocomplete="off" value="{{ $company->instagram ?? '' }}">
					</div>
					<div class="field">
						<label>Twitter</label>
						<input type='text' name='twitter' id='twitter' placeholder="Twitter" autocomplete="off" value="{{ $company->twitter ?? '' }}">
					</div>
				</div>
				<div class="ui segment">
						<div class='sixteen wide field'>
							<label>{{isset($company) ? 'Ganti' : ''}} Background Login <span style="font-size: 8pt; font-weight: normal;">(Maks. 5MB)</span></label>
							<input type='file' class='ui button' name='login_background' id='login_background' accept='.png, .jpg, .jpeg'>
						</div>
					<div class='ui small images' id='imgPreview'>
						@if(isset($company))
							@if(isset($company->login_background))
								<div class='ui small image rounded'>
									<img src="{{ URL::asset($company->login_background) }}" alt="{{ $company->login_background }}">
								</div>
							@else
								<div class='ui small image rounded'>
									Tidak ada gambar
								</div>
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class='ui grid'>
			<div class="column">
				<button type='button' onclick="showModalConfirm()" class='ui green button'><i class='save icon'></i>Simpan</button>
			</div>
		</div>
	</form>
@endsection

@section('additional')
    <div class="ui basic modal" id="modalConfirm">
		<div class="ui icon header">
			<i class="save icon"></i>
			Apakah anda yakin ingin mengubah informasi perusahaan?
		</div>
		<div class="actions">
			<div class="ui red basic cancel inverted button">
				<i class="remove icon"></i>
				Batal
			</div>
			<button type="button" onclick="submitForm()" class="ui green ok inverted button">
				<i class="checkmark icon"></i>
				Ya
			</button>
		</div>
	</div>
@endsection