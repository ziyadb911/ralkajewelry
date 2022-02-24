@extends('admin.layouts.master')

@section('jsready')
    $('#dtptglmin').calendar({
        monthFirst: false,
        type: 'date',
        formatter: { date: dateformat },
        endCalendar: $('#dtptglmaks'),
    });

    $('#dtptglmaks').calendar({
        monthFirst: false,
        type: 'date',
        formatter: { date: dateformat },
        startCalendar: $('#dtptglmin'),
    });

    $('#formSearch').submit(function (e) {
        $('#tglmin').val(formatDateValue($('#dtptglmin').calendar('get date')));
        $('#tglmaks').val(formatDateValue($('#dtptglmaks').calendar('get date')));
        $('#formSearch').addClass('loading');
        $('#formSearch').find('input').each(function() {
            var input = $(this);
            if (!input.val() || input.val() == "") {
                input.prop('disabled', true);
            }
        });
    });

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
    function showModalHapus(id, judul, route){
        $("#judulHapus").html(judul);
        $("#formHapus").attr('action', route);
        $("#modalHapus").modal("show");
    }
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='newspaper small icon'></i>Artikel</h2>
    <div class="ui inverted dimmer dimmerloading">
		<div class="ui active loader"></div>
	</div>
    <a class='ui blue button' href="{{ route('admin.artikel.tambah') }}"><i class='plus icon'></i>Tambah Artikel</a>
    <br><br>
    <form class='ui form' id="formSearch" action="" method='GET'>
        <input type='hidden' name="tglmin" id='tglmin'>
        <input type='hidden' name="tglmaks" id='tglmaks'>
        <div class="fields">
            <div class='six wide field'>
                <label>Judul</label>
                <input type='text' name='judul' placeholder='Judul' autocomplete="off" value="{{ request()->get('judul') ?? '' }}" />
            </div>
            <div class='four wide field'>
                <label>Kategori</label>
                <select class='ui search selection dropdown' id="kategori" name="kategori">
                    <option value="">Kategori</option>
                    @foreach ($articleCategories as $articleCategory)
                        <option value="{{ $articleCategory->id }}"{{ request()->get("kategori") == $articleCategory->id ? ' selected' : '' }}>{{ $articleCategory->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="fields">
            <div class='four wide field'>
                <label>Tanggal Buat Min</label>
                <div class='ui calendar' id='dtptglmin'>
                    <div class='ui input right icon'>
                        <input type='text' placeholder='Tanggal Buat Min' autocomplete='off' value="{{ request()->get('tglmin') ?? '' }}">
                        <i class='calendar icon'></i>
                    </div>
                </div>
            </div>
            <div class='four wide field'>
                <label>Tanggal Buat Maks</label>
                <div class='ui calendar' id='dtptglmaks'>
                    <div class='ui input right icon'>
                        <input type='text' placeholder='Tanggal Buat Maks' autocomplete='off' value="{{ request()->get('tglmaks') ?? '' }}">
                        <i class='calendar icon'></i>
                    </div>
                </div>
            </div>
            <div class='four wide field'>
                <label>Status</label>
                <select class='ui selection dropdown' id="status" name="status">
                    <option value="">Status</option>
                    <option value="1"{{ request()->get("status") == '1' ? ' selected' : '' }}>Publish</option>
                    <option value="0"{{ request()->get("status") == '0' ? ' selected' : '' }}>Hidden</option>
                </select>
            </div>
            <div class='field'>
                <label>&nbsp;</label>
                <button type="submit" class='ui blue button'><i class='search icon'></i>Cari</button>
            </div>
        </div>
    </form>
    @if (count($articles) > 0)
        <table class='ui table'>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tag</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $data)
                    <tr>
                        <td>{{ $data->title ?? '' }}</td>
                        <td>
                            @if(isset($data->articleCategory))
                                <div class="ui purple horizontal label">{{ $data->articleCategory->name }}</div>
                            @endif
                        </td>
                        <td>
                            @if(isset($data->tags) && count($data->tags) > 0)
                                @foreach($data->tags as $row)
                                    <div class="ui grey horizontal label">{{ $row->name }}</div>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $data->created_at_date ?? '' }}</td>
                        <td>
                            <div class="ui {{ $data->is_shown == 1 ? 'teal' : 'red' }} horizontal label">
                                {{ $data->is_shown == 1 ? 'PUBLISH' : 'HIDDEN' }}
                            </div>
                        </td>
                        <td>
                            <a class='ui small blue icon button popuphover' href="{{ route('admin.artikel.lihat', ['article' => $data]) }}" data-content="Detail">
                                <i class="info icon"></i>
                            </a>
                            <div class="ui icon top left pointing dropdown button actionbutton popuphover" data-content="Lainnya">
                                <i class="settings icon"></i>
                                <div class="menu">
                                    <a class='item' href="{{ route('admin.artikel.ubah', ['article' => $data]) }}">
                                        <i class='write icon'></i>Ubah
                                    </a>
                                    <a class='item' onclick="showModalHapus({{ $data->id }}, '{{ $data->title }}', '{{ route('admin.artikel.hapus', ['article' => $data]) }}')">
                                        <i class='eye blue icon'></i>Publish
                                    </a>
                                    <a class='item' onclick="">
                                        <i class='trash red icon'></i>Hapus
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class='ui divider'></div>
        <div class='ui grid'>
            <div class='center aligned column'>
                {{ $articles->appends(request()->except('page'))->links() }}
            </div>
        </div>
    @else
        <div class="ui placeholder segment">
            <div class="ui icon header">
                <i class="dont icon"></i>
                @if (count(request()->all()) > 0)
                    Tidak ada artikel dengan pencarian tersebut
                @else
                    Tidak ada artikel yang terdaftar
                @endif
            </div>
            @if (count(request()->all()) == 0)
                <a class="ui blue button" href="{{ route('admin.artikel.tambah') }}"><i class='plus icon'></i>Tambah Artikel</a>
            @endif
        </div>
    @endif
@endsection

@section('additional')
    <div class="ui basic modal" id='modalHapus'>
        <div class="ui icon header">
            <i class="trash icon"></i>
            Apakah anda yakin ingin menghapus artikel ini?
        </div>
        <div class="content">
            <p style="text-align: center" id="judulHapus"></p>
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
