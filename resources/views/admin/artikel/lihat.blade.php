@extends('admin.layouts.master')

@section('jsready')
@endsection

@section('jsfunction')
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='newspaper small icon'></i>Detail Artikel</h2>
    <a class='ui yellow button' href="{{ route('admin.artikel') }}"><i class='left arrow icon'></i>Kembali</a>
    <table class='ui very basic table'>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Judul</h4></td>
			<td style="width:85%">{{ $article->title }}</td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Kategori</h4></td>
			<td style="width:85%">
                @isset($article->articleCategory->name)
                    <div class="ui purple horizontal label">{{ $article->articleCategory->name }}</div>
                @endisset
            </td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Tag</h4></td>
			<td style="width:85%">
                @if(count($article->tags) > 0)
                    @foreach($article->tags as $data)
                        <div class="ui grey horizontal label">{{ $data->name }}</div>
                    @endforeach
                @endif
            </td>
		</tr>
        <tr>
            <td style="width:15%"><h4 class='ui header'>Status</h4></td>
            <td style="width:85%">
                <div class="ui {{ $article->is_shown == 1 ? 'teal' : 'red' }} horizontal label">
                    {{ $article->is_shown == 1 ? 'PUBLISH' : 'HIDDEN' }}
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:15%"><h4 class='ui header'>Dibuat</h4></td>
            <td style="width:85%">{{ $article->userCreate->name }} - {{ $article->created_at_formatted }}</td>
        </tr>
        <tr>
            <td style="width:15%"><h4 class='ui header'>Terakhir Diubah</h4></td>
            <td style="width:85%">{{ $article->userUpdate->name }} - {{ $article->updated_at_formatted }}</td>
        </tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Gambar</h4></td>
			<td style="width:85%">
                @isset($article->image_url)
                    <a href="{{ URL::asset($article->image_url) }}" target="_blank" class='ui medium rounded image'>
                        <img src="{{ URL::asset($article->image_url) }}" alt="{{ $article->image_url }}"/>
                    </a>
                @endisset
            </td>
		</tr>
		<tr>
			<td style="width:15%"><h4 class='ui header'>Isi</h4></td>
			<td style="width:85%">{!! $article->content !!}</td>
		</tr>
    </table>
@endsection

@section('additional')
@endsection
