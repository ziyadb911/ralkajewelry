@extends('admin.layouts.master')

@section('jsready')
@endsection

@section('jsfunction')
@endsection

@section('content')
    <h2 class='ui dividing header'><i class='dashboard small icon'></i>Dashboard</h2>
    <div class="ui three column grid stackable">
        <div class="column">
            <div class="ui fluid card">
                <div class="content">
                    <div class="ui right floated header blue">
                        <i class="calendar alternate blue icon"></i>
                    </div>
                    <div class="header">
                        <div class="ui blue header">
                            {{ DateHelper::dateToStringIndonesia(now()) }}
                        </div>
                    </div>
                    <div class="meta">
                        Hari ini
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui fluid card">
                <div class="content">
                    <div class="ui right floated header teal">
                        <i class="comment teal icon"></i>
                    </div>
                    <div class="header">
                        <div class="ui teal header">
                            {{ number_format($unreadResponseCount, 0, null, '.') }}
                        </div>
                    </div>
                    <div class="meta">
                        Respon Customer Belum Dibaca
                    </div>
                </div>
                <div class="extra content center aligned">
                    <a href="{{ route('admin.responcustomer') }}" class="ui teal fluid button">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
    <h3 class='ui dividing header'>Respon Customer Belum Dibaca</h3>
    <table class='ui table'>
        <thead>
            <tr>
                <th>Nama</th>
                <th>No. Handphone</th>
                <th>Email</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @if (count($customerResponses) > 0)
                @foreach ($customerResponses as $data)
                <tr>
                    <td>{{ $data->name ?? '' }}</td>
                    <td>{{ $data->phone ?? '' }}</td>
                    <td>{{ $data->email ?? '' }}</td>
                    <td>{{ $data->created_at_formatted ?? '' }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="text-align: center">Tidak ada respon customer belum dibaca</td>
                <tr>
            @endif
        </tbody>
    </table>
@endsection

@section('additional')
@endsection
