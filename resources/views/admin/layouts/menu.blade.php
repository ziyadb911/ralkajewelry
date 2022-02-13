<div class='item'>
    <h3 class='ui inverted header'>Ralka Jewelry</h3>
    <h5 class='ui inverted header'>Panel Admin<br>
        USER
    </h5>
</div>

<a class="{{ Route::currentRouteName() == 'home' ? 'active ' : '' }}item"
    href="#">
    <i class="globe asia icon"></i>Halaman Umum
</a>

<a class="{{ strpos(Route::currentRouteName(), 'admin dashboard') !== false ? 'active ' : '' }}item"
    href="#">
    <i class='dashboard icon'></i>Dashboard
</a>
<div class='item'>
    <div class="{{ strpos(Route::currentRouteName(), 'admin akun') !== false ? 'active ' : '' }}title">
        <i class="dropdown icon"></i>
        <i class='user icon'></i>
        Akun
    </div>
    <div class="{{ strpos(Route::currentRouteName(), 'admin akun') !== false ? 'active ' : '' }} content">
        <a class="{{ Route::currentRouteName() == 'admin akun ubah' ? 'active ' : '' }}item"
            href="#">
            <i class='user edit icon'></i>Ubah Akun
        </a>
        <a class="{{ Route::currentRouteName() == 'admin akun gantipass' ? 'active ' : '' }}item"
            href="#">
            <i class='lock icon'></i>Ganti Password
        </a>
    </div>
</div>
<a class="item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class='sign out icon'></i>Logout</a>
<form id="logout-form" action="#" method="POST" style="display: none;">
    @csrf
</form>