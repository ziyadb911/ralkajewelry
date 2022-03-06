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
    function showModalHapus(id, name, route){
        $("#namaHapus").html(name);
        $("#formHapus").attr('action', route);
        $("#modalHapus").modal("show");
    }
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='comment small icon'></i>Respon Customer</h2>
    <div class="ui inverted dimmer dimmerloading">
		<div class="ui active loader"></div>
	</div>
    <form class='ui form' id="formSearch" action="" method='GET'>
        <input type='hidden' name="tglmin" id='tglmin'>
        <input type='hidden' name="tglmaks" id='tglmaks'>
        <div class="fields">
            <div class='five wide field'>
                <label>Cari</label>
                <input type='text' name='keyword' placeholder='Nama / No. Handphone / Email' autocomplete="off" value="{{ request()->get('keyword') ?? '' }}" />
            </div>
            <div class='four wide field'>
                <label>Status</label>
                <select class='ui selection dropdown' id="status" name="status">
                    <option value="">Status</option>
                    <option value="0"{{ request()->get("status") == '0' ? ' selected' : '' }}>Belum Dibaca</option>
                    <option value="1"{{ request()->get("status") == '1' ? ' selected' : '' }}>Sudah Dibaca</option>
                </select>
            </div>
        </div>
        <div class="fields">
            <div class='four wide field'>
                <label>Tanggal Min</label>
                <div class='ui calendar' id='dtptglmin'>
                    <div class='ui input right icon'>
                        <input type='text' placeholder='Tanggal Min' autocomplete="off" value="{{ request()->get('tglmin') ?? '' }}">
                        <i class='calendar icon'></i>
                    </div>
                </div>
            </div>
            <div class='four wide field'>
                <label>Tanggal Maks</label>
                <div class='ui calendar' id='dtptglmaks'>
                    <div class='ui input right icon'>
                        <input type='text' placeholder='Tanggal Maks' autocomplete="off" value="{{ request()->get('tglmaks') ?? '' }}">
                        <i class='calendar icon'></i>
                    </div>
                </div>
            </div>
            <div class='field'>
                <label>&nbsp;</label>
                <button type="submit" class='ui blue button'><i class='search icon'></i>Cari</button>
            </div>
        </div>
    </form>
    @if (count($customerResponses) > 0)
        <table class='ui table'>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No. Handphone</th>
                    <th>Email</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customerResponses as $data)
                    <tr>
                        <td>{{ $data->name ?? '' }}</td>
                        <td>{{ $data->phone ?? '' }}</td>
                        <td>{{ $data->email ?? '' }}</td>
                        <td>{{ $data->created_at_formatted ?? '' }}</td>
                        <td>
                            <div class="ui {{ $data->is_readed == 1 ? 'teal' : 'grey' }} horizontal label">
                                {{ $data->is_readed == 1 ? 'SUDAH DIBACA' : 'BELUM DIBACA' }}
                            </div>
                        </td>
                        <td>
                            <a class='ui small blue icon button popuphover' href="{{ route('admin.responcustomer.lihat', ['customerResponse' => $data]) }}" data-content="Detail">
                                <i class="info icon"></i>
                            </a>
                            <a class='ui small red icon button popuphover' onclick="showModalHapus({{ $data->id }}, '{{ $data->name }}', '{{ route('admin.responcustomer.hapus', ['customerResponse' => $data]) }}')" data-content="Hapus">
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
                {{ $customerResponses->appends(request()->except('page'))->links() }}
            </div>
        </div>
    @else
        <div class="ui placeholder segment">
            <div class="ui icon header">
                <i class="dont icon"></i>
                @if (count(request()->all()) > 0)
                    Tidak ada respon customer dengan pencarian tersebut
                @else
                    Tidak ada respon customer yang terdaftar
                @endif
            </div>
        </div>
    @endif
@endsection

@section('additional')
    <div class="ui basic modal" id='modalHapus'>
        <div class="ui icon header">
            <i class="trash icon"></i>
            Apakah anda yakin ingin menghapus respon customer "<span id="namaHapus"></span>"?
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
