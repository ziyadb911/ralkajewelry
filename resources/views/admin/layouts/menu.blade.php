<div class='item'>
    <h3 class='ui inverted header'>Ralka Jewelry</h3>
    <h5 class='ui inverted header'>Panel Admin<br>
        {{ auth()->user()->name }}
    </h5>
</div>

<a class="{{ Request::routeIs('home') ? 'active ' : '' }}item" href="{{ route('home') }}">
    <i class="globe asia icon"></i>Halaman Umum
</a>

<a class="{{ Request::routeIs('admin.dashboard') ? 'active ' : '' }}item"
    href="{{ route('admin.dashboard') }}">
    <i class='dashboard icon'></i>Dashboard
</a>
<div class="item">
    <div class="title">
        <i class="dropdown icon"></i>
        <i class="list icon"></i>
        Master
    </div>
    <div class="{{ Request::routeIs(['admin.tag*', 'admin.kategoriartikel*', 'admin.artikel*']) ? 'active ' : '' }}content">
        <a class="{{ Request::routeIs('admin.tag*') ? 'active ' : '' }}item" href="{{ route('admin.tag') }}">
            <i class="tags icon"></i>Tag 
        </a>
        <a class="{{ Request::routeIs('admin.kategoriartikel*') ? 'active ' : '' }}item" href="{{ route('admin.kategoriartikel') }}">
            <i class="filter icon"></i>Kategori Artikel
        </a>
        <a class="{{ Request::routeIs('admin.artikel*') ? 'active ' : '' }}item" href="{{ route('admin.artikel') }}">
            <i class="newspaper icon"></i>Artikel
        </a>
    </div>
</div>
{{-- <a class="{{ strpos(Route::currentRouteName(), 'admin.banner') !== false ? 'active ' : '' }}item" href="#">
    <i class='flag icon'></i>Banner
</a> --}}
<a class="{{ Request::routeIs('admin.infoperusahaan') ? 'active ' : '' }}item" href="{{ route('admin.infoperusahaan') }}">
    <i class='building icon'></i>Informasi Perusahaan
</a>
<div class='item'>
    <div class="{{ Request::routeIs('admin.akun*') ? 'active ' : '' }}title">
        <i class="dropdown icon"></i>
        <i class='user icon'></i>
        Akun
    </div>
    <div class="{{ Request::routeIs('admin.akun*') ? 'active ' : '' }} content">
        <a class="{{ Request::routeIs('admin.akun.ubah') ? 'active ' : '' }}item"
            href="{{ route('admin.akun.ubah') }}">
            <i class='user edit icon'></i>Ubah Akun
        </a>
        <a class="{{ Request::routeIs('admin.akun.gantipass') ? 'active ' : '' }}item"
            href="{{ route('admin.akun.gantipass') }}">
            <i class='lock icon'></i>Ganti Password
        </a>
    </div>
</div>
<a class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class='sign out icon'></i>Logout
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
