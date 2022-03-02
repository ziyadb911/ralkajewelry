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
                <li><a class="nav-link scrollto{{ Request::routeIs('home') ? ' active ' : '' }}" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#services">Services</a></li>
                <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
                <li><a class="nav-link scrollto" href="#team">Team</a></li>
                <li><a class="{{ Request::routeIs('artikel*') ? 'active ' : '' }}"href="{{ route('artikel') }}">Artikel</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
