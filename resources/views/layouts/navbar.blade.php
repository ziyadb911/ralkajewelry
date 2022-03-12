<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

        <div class="logo">
            <h1><a href="{{ route('home') }}"><span>Ralka</span>Jewelry</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            {{-- <a href="index.html"><img src="{{ URL::asset('img/logo.png') }}" alt="" class="img-fluid"></a> --}}
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="{{ Request::routeIs('artikel*') ? route('home') : '' }}#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="{{ Request::routeIs('artikel*') ? route('home') : '' }}#about">Tentang Kami</a></li>
                <li><a class="nav-link scrollto" href="{{ Request::routeIs('artikel*') ? route('home') : '' }}#services">Layanan</a></li>
                <li><a class="nav-link scrollto" href="{{ Request::routeIs('artikel*') ? route('home') : '' }}#portfolio">Galeri</a></li>
                <li><a class="nav-link scrollto" href="{{ Request::routeIs('artikel*') ? route('home') : '' }}#blog">Artikel</a></li>
                <li><a class="nav-link scrollto" href="{{ Request::routeIs('artikel*') ? route('home') : '' }}#contact">Hubungi Kami</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
