<div class='item'>
    <h3 class='ui inverted header'>Ralka Jewelry</h3>
    <h5 class='ui inverted header'>Panel Admin<br>
        {{ auth()->user()->name }}
    </h5>
</div>

<a class="{{ Route::currentRouteName() == 'home' ? 'active ' : '' }}item" href="{{ route('home') }}">
    <i class="globe asia icon"></i>Halaman Umum
</a>

<a class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'active ' : '' }}item"
    href="{{ route('admin.dashboard') }}">
    <i class='dashboard icon'></i>Dashboard
</a>
<a class="{{ strpos(Route::currentRouteName(), 'admin.banner') !== false ? 'active ' : '' }}item" href="#">
    <i class='flag icon'></i>Banner
</a>
<a class="{{ strpos(Route::currentRouteName(), 'admin.artikel') !== false ? 'active ' : '' }}item" href="#">
    <i class='newspaper icon'></i>Artikel
</a>
<div class='item'>
    <div class="{{ strpos(Route::currentRouteName(), 'admin.akun.') !== false ? 'active ' : '' }}title">
        <i class="dropdown icon"></i>
        <i class='user icon'></i>
        Akun
    </div>
    <div class="{{ strpos(Route::currentRouteName(), 'admin.akun.') !== false ? 'active ' : '' }} content">
        <a class="{{ Route::currentRouteName() == 'admin.akun.ubah' ? 'active ' : '' }}item"
            href="{{ route('admin.akun.ubah') }}">
            <i class='user edit icon'></i>Ubah Akun
        </a>
        <a class="{{ Route::currentRouteName() == 'admin.akun.gantipass' ? 'active ' : '' }}item"
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
