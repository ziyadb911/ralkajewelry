@extends('admin.layouts.master')

@section('jsready')
	$('#formUbahAkun').form({
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
					type   : 'maxLength[200]',
					prompt : 'Nama maksimal 200 karakter'
				}]
			},
			email:{
				identifier: 'email',
				rules: [{
					type   : 'empty',
					prompt : 'Email tidak boleh kosong'
				},{
					type   : 'minLength[2]',
					prompt : 'Email minimal 2 karakter'
				},{
					type   : 'maxLength[100]',
					prompt : 'Email maksimal 100 karakter'
				}]
			},
			username:{
				identifier: 'username',
				rules: [{
					type   : 'empty',
					prompt : 'Username tidak boleh kosong'
				},{
					type   : 'minLength[2]',
					prompt : 'Username minimal 2 karakter'
				},{
					type   : 'maxLength[100]',
					prompt : 'Username maksimal 100 karakter'
				}]
			}
		}
	});

	$('#formUbahAkun').submit(function(e){
        e.preventDefault();
        if($('#formUbahAkun').form('is valid')){
            var frm = $(this);
            frm.addClass('loading');
			ajaxPost(this).done(function (data) {
                frm.removeClass('loading');
                showMessage("info", data.message, "{{ route('admin.akun.ubah') }}");
            }).fail(function (data) {
                frm.removeClass('loading');
            })
        }
    });
@endsection

@section('jsfunction')
	function showModalConfirm(){
		$('#formUbahAkun').form('validate form');
		if($('#formUbahAkun').form('is valid')){
			$("#modalConfirm").modal("show");
		}
	}
	
	function submitForm(){
		$("#formUbahAkun").submit();
	}
@endsection

@section('content')
	<h2 class='ui dividing header'><i class='user edit small icon'></i>Ubah Akun</h2>
	<div class='ui grid'>
		<div class='six wide computer sixteen wide mobile column'>
			<form class="ui form" action="{{ route('admin.akun.ubah.post') }}" method="POST" id='formUbahAkun'>
				@csrf
				<div class='ui error message'></div>
				<div class="required field">
					<label>Nama</label>
					<input type="text" name="name" id='name' placeholder="Nama" autocomplete="off" value="{{ $user->name ?? '' }}">
				</div>
				<div class="required field">
					<label>Email</label>
					<input type='text' name='email' id='email' placeholder="Email" autocomplete="off" value="{{ $user->email ?? '' }}">
				</div>
				<div class="required field">
					<label>Username</label>
					<input type="text" name="username" id='username' placeholder="Username" autocomplete="off" value="{{ $user->username ?? '' }}">
				</div>
				
				<button type='button' onclick="showModalConfirm()" class='ui green button'><i class='save icon'></i>Simpan</button>
			</form>
		</div>
	</div>
@endsection

@section('additional')
    <div class="ui basic modal" id="modalConfirm">
		<div class="ui icon header">
			<i class="save icon"></i>
			Apakah anda yakin ingin mengubah akun?
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