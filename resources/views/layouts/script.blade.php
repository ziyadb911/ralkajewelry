<!-- Vendor JS Files -->
<script src="{{ URL::asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ URL::asset('js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        @yield('jsready')
    });

    @yield('jsfunction')
</script>
