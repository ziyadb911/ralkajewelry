@extends('admin.layouts.master')

@section('jsready')
@endsection

@section('jsfunction')
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='filter small icon'></i>Detail Kategori Artikel</h2>
    <a class='ui yellow button' href="{{ route('admin.kategoriartikel') }}"><i class='left arrow icon'></i>Kembali</a>
    <table class='ui very basic table'>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Nama Kategori Artikel</h4></td>
			<td style="width:85%">{{ $articleCategory->name }}</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Dibuat</h4></td>
			<td style="width:85%">{{ $articleCategory->created_at_formatted }}</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Terakhir Diubah</h4></td>
			<td style="width:85%">{{ $articleCategory->updated_at_formatted }}</td>
		</tr>
    </table>
@endsection

@section('additional')
@endsection
