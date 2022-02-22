@extends('admin.layouts.master')

@section('jsready')
@endsection

@section('jsfunction')
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='tags small icon'></i>Detail Tag</h2>
    <a class='ui yellow button' href="{{ url()->previous() }}"><i class='left arrow icon'></i>Kembali</a>
    <table class='ui very basic table'>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Nama</h4></td>
			<td style="width:85%">{{ $tag->name }}</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Dibuat</h4></td>
			<td style="width:85%">{{ $tag->created_at_formatted }}</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Terakhir Diubah</h4></td>
			<td style="width:85%">{{ $tag->updated_at_formatted }}</td>
		</tr>
    </table>
@endsection

@section('additional')
@endsection
