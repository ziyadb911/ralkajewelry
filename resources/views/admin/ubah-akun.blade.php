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
	
@endsection

@section('content')
	<h2 class='ui dividing header'>Ubah Akun</h2>
	<div class='ui grid'>
		<div class='six wide computer sixteen wide mobile column'>
			<form class="ui form" action="{{ route('admin.akun.ubah.post') }}" method="POST" id='formUbahAkun'>
				@csrf
				<div class='ui error message'>

				</div>
				<div class="required field">
					<label>Nama</label>
					<input type="text" name="name" id='name' placeholder="Nama" value="{{ $user->name ?? '' }}">
				</div>
				<div class="required field">
					<label>Email</label>
					<input type='text' name='email' id='email' placeholder="Email" value="{{ $user->email ?? '' }}">
				</div>
				<div class="required field">
					<label>Username</label>
					<input type="text" name="username" id='username' placeholder="Username" value="{{ $user->username ?? '' }}">
				</div>
				
				<button type='submit' class='ui green button'><i class='save icon'></i>Simpan</button>
			</form>
		</div>
	</div>
@endsection