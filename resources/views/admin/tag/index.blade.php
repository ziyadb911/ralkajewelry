@extends('admin.layouts.master')

@section('jsready')
    $('#formHapus').submit(function(e){
        e.preventDefault();
        $('.dimmerloading').dimmer('show');

        ajaxPost(this).done(function(data){
            $('.dimmerloading').dimmer('hide');
            showMessage("info", data.message, "{!! Request::fullUrl() !!}");
        }).fail(function(data){
            $('.dimmerloading').dimmer('hide');
        })
    });
@endsection

@section('jsfunction')
    function showModalHapus(id, name, route){
        $("#namaHapus").html(name);
        $("#formHapus").attr('action', route);
        $("#modalHapus").modal("show");
    }
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='tags small icon'></i>Tag</h2>
    <div class="ui inverted dimmer dimmerloading">
		<div class="ui active loader"></div>
	</div>
    <a class='ui blue button' href="{{ route('admin.tag.tambah') }}"><i class='plus icon'></i>Tambah Tag</a>
    <br><br>
    <form class='ui form formsearch' action="" method='GET'>
        <div class="fields">
            <div class='five wide field'>
                <label>Nama Tag</label>
                <input type='text' name='nama' placeholder='Nama Tag' autocomplete="off" value="{{ request()->get('nama') ?? '' }}" />
            </div>
            <div class='field'>
                <label>&nbsp;</label>
                <button type="submit" class='ui blue button'><i class='search icon'></i>Cari</button>
            </div>
        </div>
    </form>
    @if (count($tags) > 0)
        <table class='ui table'>
            <thead>
                <tr>
                    <th>Nama Tag</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $data)
                    <tr>
                        <td>{{ $data->name ?? '' }}</td>
                        <td>
                            <a class='ui small blue icon button popuphover' href="{{ route('admin.tag.lihat', ['tag' => $data]) }}" data-content="Detail">
                                <i class="info icon"></i>
                            </a>
                            <a class='ui small yellow icon button popuphover' href="{{ route('admin.tag.ubah', ['tag' => $data]) }}" data-content="Ubah">
                                <i class="write icon"></i>
                            </a>
                            <a class='ui small red icon button popuphover' onclick="showModalHapus({{ $data->id }}, '{{ $data->name }}', '{{ route('admin.tag.hapus', ['tag' => $data]) }}')" data-content="Hapus">
                                <i class='trash icon'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class='ui divider'></div>
        <div class='ui grid'>
            <div class='center aligned column'>
                {{ $tags->appends(request()->except('page'))->links() }}
            </div>
        </div>
    @else
        <div class="ui placeholder segment">
            <div class="ui icon header">
                <i class="dont icon"></i>
                @if (count(request()->all()) > 0)
                    Tidak ada tag dengan pencarian tersebut
                @else
                    Tidak ada tag yang terdaftar
                @endif
            </div>
            @if (count(request()->all()) == 0)
                <a class="ui blue button" href="{{ route('admin.tag.tambah') }}"><i class='plus icon'></i>Tambah Tag</a>
            @endif
        </div>
    @endif
@endsection

@section('additional')
    <div class="ui basic modal" id='modalHapus'>
        <div class="ui icon header">
            <i class="trash icon"></i>
            Apakah anda yakin ingin menghapus tag "<span id="namaHapus"></span>"?
        </div>
        <div class="content">
            <form style="display:none" id="formHapus" action="" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
        <div class="actions">
            <div class="ui red basic cancel inverted button">
                <i class="remove icon"></i>
                Batal
            </div>
            <button type='submit' form="formHapus" class="ui green ok inverted button">
                <i class="checkmark icon"></i>
                Ya
            </button>
        </div>
    </div>
@endsection
