@extends('admin.layouts.master')

@section('jsready')
@endsection

@section('jsfunction')
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='comment small icon'></i>Detail Respon Customer</h2>
    <a class='ui yellow button' href="{{ route('admin.responcustomer') }}"><i class='left arrow icon'></i>Kembali</a>
    <table class='ui very basic table'>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Nama</h4></td>
			<td style="width:85%">{{ $customerResponse->name }}</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>No. Handphone</h4></td>
			<td style="width:85%">{{ $customerResponse->phone }}</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Email</h4></td>
			<td style="width:85%">{{ $customerResponse->email }}</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Tanggal</h4></td>
			<td style="width:85%">{{ $customerResponse->created_at_formatted }}</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Status</h4></td>
			<td style="width:85%">
				<div class="ui {{ $customerResponse->is_readed == 1 ? 'teal' : 'grey' }} horizontal label">
					{{ $customerResponse->is_readed == 1 ? 'SUDAH DIBACA' : 'BELUM DIBACA' }}
				</div>
			</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Pesan</h4></td>
			<td style="width:85%">{{ $customerResponse->message }}</td>
		</tr>
    </table>
@endsection

@section('additional')
@endsection
