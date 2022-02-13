<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.meta')
    
    @yield('head')
</head>

<body>
    @include('layouts.navbar')

    @yield('content')

    @yield('additional')

    @include('layouts.footer')

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
    @include('layouts.script')
</body>

</html>
