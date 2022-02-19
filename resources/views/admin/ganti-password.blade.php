@extends('admin.layouts.master')

@section('jsready')
	@if(session()->has('pesan'))
		alert("{{session('pesan')}}");
	@endif
	$('.ui.dropdown').dropdown();
		$('#formGantiPass').form({
		fields: {
			oldpass:{
				identifier: 'oldpass',
				rules: [{
					type   : 'empty',
					prompt : 'Password lama tidak boleh kosong'
				}]
			},
			newpassdiff:{
				identifier: 'newpass',
				rules: [{
					type   : 'different[oldpass]',
					prompt : 'Password baru masih sama dengan password lama'
				}]
			},
			newpass:{
				identifier: 'newpass',
				rules: [{
					type   : 'minLength[5]',
					prompt : 'Password baru minimal 5 karakter'
				}]
			},
			confnewpass:{
				identifier: 'confnewpass',
				rules: [{
					type   : 'match[newpass]',
					prompt : 'Konfirmasi password tidak sama'
				}]
			}
		}
	});
@endsection

@section('jsfunction')
function showModalConfirm(){
		$('#formGantiPass').form('validate form');
		if($('#formGantiPass').form('is valid')){
			$("#modalConfirm").modal("show");
		}
	}
	
	function submitForm(){
		$('#formGantiPass').addClass('loading');
		$("#formGantiPass").submit();
	}
@endsection

@section('content')
	<h2 class='ui dividing header'>Ganti Password</h2>
	<div class='ui grid'>
		<div class='six wide computer sixteen wide mobile column'>
			<form class="ui form" action="{{ route('admin.akun.gantipass.post') }}" method="POST" id='formGantiPass'>
				@csrf
				<div class='ui error message'>

				</div>
				<div class="field">
					<label>Password Lama</label>
					<input type="password" name="oldpass" id='oldpass' placeholder="Password lama"/>
				</div>
				<div class="field">
					<label>Password Baru</label>
					<input type='password' name='newpass' id='newpass' placeholder="Password baru" />
				</div>
				<div class="field">
					<label>Konfirmasi Password Baru</label>
					<input type="password" name="confnewpass" id='confnewpass' placeholder="Konfirmasi password baru"/>
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
			Apakah anda yakin ingin mengganti password?
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