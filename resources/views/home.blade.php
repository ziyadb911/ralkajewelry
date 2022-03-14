@extends('layouts.master')

@section('head')
@endsection

@section('jsready')
@endsection

@section('jsfunction')
@endsection

@section('content')
    <!-- ======= hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

                <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">

                    <div class="carousel-item active" style="background-image: url({{ URL::asset('/img/bg-login') }}.jpg)">
                        <div class="carousel-container">
                            <div class="container">
                                <h2 class="animate__animated animate__fadeInDown">We build trust with you</h2>
                                <p class="animate__animated animate__fadeInUp" style="font-style: italic">Quality is what we focused on</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item" style="background-image: url({{ URL::asset('/img/bg-login') }}.jpg)">
                        <div class="carousel-container">
                            <div class="container">
                                <h2 class="animate__animated animate__fadeInDown">No fake diamonds here</h2>
                                <p class="animate__animated animate__fadeInUp" style="font-style: italic">Purity is our main purpose</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item" style="background-image: url({{ URL::asset('/img/bg-login') }}.jpg)">
                        <div class="carousel-container">
                            <div class="container">
                                <h2 class="animate__animated animate__fadeInDown">Apreciate yourself</h2>
                                <p class="animate__animated animate__fadeInUp" style="font-style: italic">You will never find diamonds that are perfect.
                                    But you always find diamonds that are perfectly yours</p>
                                <a href="#about" class="btn-get-started scrollto animate__animated animate__fadeInUp">Get
                                    Started</a>
                            </div>
                        </div>
                    </div>

                </div>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>

            </div>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <div id="about" class="about-area area-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline text-center">
                            <h2>Tentang Kami</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- single-well start-->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="well-left">
                            <div class="single-well">
                                <a href="#">
                                    <img src="{{ URL::asset('/img/about/1.jpg') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- single-well end-->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="well-middle">
                            <div class="single-well">
                                <a href="#">
                                    <h4 class="sec-head">Ralka Jewelry</h4>
                                </a>
                                <p>
                                    kami adalah bla bla bla..
                                </p>
                                <p>
                                    ini teks visi..
                                </p>
                                <ul>
                                    <li>
                                        <i class="bi bi-check"></i> Interior design Package
                                    </li>
                                    <li>
                                        <i class="bi bi-check"></i> Building House
                                    </li>
                                    <li>
                                        <i class="bi bi-check"></i> Reparing of Residentail Roof
                                    </li>
                                    <li>
                                        <i class="bi bi-check"></i> Renovaion of Commercial Office
                                    </li>
                                    <li>
                                        <i class="bi bi-check"></i> Make Quality Products
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End col-->
                </div>
            </div>
        </div><!-- End About Section -->

        <!-- ======= Services Section ======= -->
        <div id="services" class="services-area area-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline services-head text-center">
                            <h2>Layanan Kami</h2>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <!-- Start Left services -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="about-move">
                            <div class="services-details">
                                <div class="single-services">
                                    <div class="services-icon">
                                        <i class="bi bi-gem"></i>
                                    </div>
                                    <h4>Custom Ring</h4>
                                    <p>
                                        will have to make sure the prototype looks finished by inserting text or
                                        photo.make sure the prototype looks finished by.
                                    </p>
                                </div>
                            </div>
                            <!-- end about-details -->
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="about-move">
                            <div class="services-details">
                                <div class="single-services">
                                    <div class="services-icon">
                                        <i class="bi bi-droplet-half"></i>
                                    </div>
                                    <h4>Chroming</h4>
                                    <p>
                                        will have to make sure the prototype looks finished by inserting text or
                                        photo.make sure the prototype looks finished by.
                                    </p>
                                </div>
                            </div>
                            <!-- end about-details -->
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <!-- end col-md-4 -->
                        <div class=" about-move">
                            <div class="services-details">
                                <div class="single-services">
                                    <div class="services-icon">
                                        <i class="bi bi-arrows-angle-expand"></i>
                                    </div>
                                    <h4>Resizing</h4>
                                    <p>
                                        will have to make sure the prototype looks finished by inserting text or
                                        photo.make sure the prototype looks finished by.
                                    </p>
                                </div>
                            </div>
                            <!-- end about-details -->
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12"></div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <!-- end col-md-4 -->
                        <div class=" about-move">
                            <div class="services-details">
                                <div class="single-services">
                                    <div class="services-icon">
                                        <i class="bi bi-vector-pen"></i>
                                    </div>
                                    <h4>Grafir</h4>
                                    <p>
                                        will have to make sure the prototype looks finished by inserting text or
                                        photo.make sure the prototype looks finished by.
                                    </p>
                                </div>
                            </div>
                            <!-- end about-details -->
                        </div>
                    </div>
                    <!-- End Left services -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <!-- end col-md-4 -->
                        <div class=" about-move">
                            <div class="services-details">
                                <div class="single-services">
                                    <div class="services-icon">
                                        <i class="bi bi-card-heading"></i>
                                    </div>
                                    <h4>Sertifikasi Berlian</h4>
                                    <p>
                                        will have to make sure the prototype looks finished by inserting text or
                                        photo.make sure the prototype looks finished by.
                                    </p>
                                </div>
                            </div>
                            <!-- end about-details -->
                        </div>
                    </div>
                    <!-- End Left services -->
                    <div class="col-md-2 col-sm-2 col-xs-12"></div>
                    {{-- <div class="col-md-4 col-sm-4 col-xs-12">
                        <!-- end col-md-4 -->
                        <div class=" about-move">
                            <div class="services-details">
                                <div class="single-services">
                                    <a class="services-icon" href="#">
                                        <i class="bi bi-calendar4-week"></i>
                                    </a>
                                    <h4>24/7 Support</h4>
                                    <p>
                                        will have to make sure the prototype looks finished by inserting text or
                                        photo.make sure the prototype looks finished by.
                                    </p>
                                </div>
                            </div>
                            <!-- end about-details -->
                        </div>
                    </div> --}}
                </div>
            </div>
        </div><!-- End Services Section -->

        <!-- ======= Rviews Section ======= -->
        <div class="reviews-area">
            <div class="row g-0">
                <div class="col-lg-6">
                    <img src="{{ URL::asset('/img/about/2.jpg') }}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 work-right-text d-flex align-items-center">
                    <div class="px-5 py-5 py-lg-0">
                        <h2>Buat perhiasan bersama kami</h2>
                        <h5>{{ $company->invitation_text ?? '' }}</h5>
                        <a href="#contact" class="ready-btn scrollto">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div><!-- End Rviews Section -->

        <!-- ======= Portfolio Section ======= -->
        <div id="portfolio" class="portfolio-area area-padding fix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline text-center">
                            <h2>Galeri</h2>
                        </div>
                    </div>
                </div>

                <div class="row awesome-project-content portfolio-container">

                    <!-- portfolio-item start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item filter-app portfolio-item">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="{{ URL::asset('img/portfolio/1.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/portfolio/1.jpg') }}">
                                            <h4>Business City</h4>
                                            <span>Web Development</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item end -->

                    <!-- portfolio-item start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item filter-web">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="{{ URL::asset('img/portfolio/2.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/portfolio/2.jpg') }}">
                                            <h4>Blue Sea</h4>
                                            <span>Photosho</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item end -->

                    <!-- portfolio-item start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item filter-card">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="{{ URL::asset('img/portfolio/3.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/portfolio/3.jpg') }}">
                                            <h4>Beautiful Nature</h4>
                                            <span>Web Design</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item end -->

                    <!-- portfolio-item start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item filter-web">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="{{ URL::asset('img/portfolio/4.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/portfolio/4.jpg') }}">
                                            <h4>Creative Team</h4>
                                            <span>Web design</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item end -->

                    <!-- portfolio-item start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item filter-app">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="{{ URL::asset('img/portfolio/5.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/portfolio/5.jpg') }}">
                                            <h4>Beautiful Flower</h4>
                                            <span>Web Development</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item end -->

                    <!-- portfolio-item start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item filter-web">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="{{ URL::asset('img/portfolio/6.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/portfolio/6.jpg') }}">
                                            <h4>Night Hill</h4>
                                            <span>Photoshop</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- portfolio-item end -->

                </div>
            </div>
        </div><!-- End Portfolio Section -->

        <!-- ======= Testimonials Section ======= -->
        <div id="testimonials" class="testimonials">
            <div class="container">

                <div class="testimonials-slider swiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <br><br>
                                {{-- <img src="{{ URL::asset('img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt=""> --}}
                                <h3>Oyek</h3>
                                <h4>Customer</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                    rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                    risus at semper.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <br><br>
                                {{-- <img src="{{ URL::asset('img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt=""> --}}
                                <h3>Oyek</h3>
                                <h4>Customer</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                    rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                    risus at semper.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <br><br>
                                {{-- <img src="{{ URL::asset('img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt=""> --}}
                                <h3>Oyek</h3>
                                <h4>Customer</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                    rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                    risus at semper.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->


                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </div><!-- End Testimonials Section -->

        <!-- ======= Blog Section ======= -->
        <div id="blog" class="blog-area">
            <div class="blog-inner area-padding">
                <div class="blog-overly"></div>
                <div class="container ">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="section-headline text-center">
                                <h2>Artikel</h2>
                            </div>
                        </div>
                    </div>
                    @if(count($recentArticles) > 0)
                        <div class="row">
                            <!-- Start Blog -->
                            @foreach($recentArticles as $recentArticle)
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="single-blog">
                                        <div class="single-blog-img">
                                            <a href="{{ route('artikel.detail', ['article' => $recentArticle]) }}">
                                                <img src="{{ $recentArticle->image_url }}" alt="">
                                            </a>
                                        </div>
                                        <div class="blog-meta">
                                            <span class="date-type">
                                                <i class="bi bi-clock"></i>{{ $recentArticle->date_indo }}
                                            </span>
                                            <span class="date-type">
                                                <i class="bi bi-folder"></i>{{ $recentArticle->articleCategory->name ?? '' }}
                                            </span>
                                        </div>
                                        <div class="blog-text">
                                            <h4>
                                                <a href="{{ route('artikel.detail', ['article' => $recentArticle]) }}">{{ $recentArticle->title }}</a>
                                            </h4>
                                            {!! (strlen($recentArticle->content) > 200) ? (substr($recentArticle->content, 0, 200) . '...') : $recentArticle->content !!}
                                        </div>
                                        <span>
                                            <a href="{{ route('artikel.detail', ['article' => $recentArticle]) }}" class="ready-btn">Baca Selengkapnya</a>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            <!-- End Blog-->
                        </div>
                    @endif
                </div>
            </div>
        </div><!-- End Blog Section -->

        <!-- ======= Suscribe Section ======= -->
        <div class="suscribe-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs=12">
                        <div class="suscribe-text text-center">
                            <h3>Artikel Lebih Lengkap</h3>
                            <a class="sus-btn" href="{{ route('artikel') }}">Baca Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Suscribe Section -->

        <!-- ======= Contact Section ======= -->
        <div id="contact" class="contact-area">
            <div class="contact-inner area-padding">
                <div class="contact-overly"></div>
                <div class="container ">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="section-headline text-center">
                                <h2>Hubungi Kami</h2>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">

                        <!-- Start Google Map -->
                        <div class="col-md-6">
                            <!-- Start Map -->
                            <div class="row">
                                <!-- Start contact icon column -->
                                <div class="col-md-12">
                                    <div class="contact-icon text-center">
                                        <div class="single-icon">
                                            <i class="bi bi-phone"></i>
                                            <p>Hubungi: {{ $company->phone1 ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start contact icon column -->
                                <div class="col-md-12">
                                    <div class="contact-icon text-center">
                                        <div class="single-icon">
                                            <i class="bi bi-envelope"></i>
                                            <p>Email: {{ $company->email ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start contact icon column -->
                                <div class="col-md-12">
                                    <div class="contact-icon text-center">
                                        <div class="single-icon">
                                            <i class="bi bi-geo-alt"></i>
                                            <p>Alamat: {!! nl2br($company->address ?? '') !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Google Map -->

                        <!-- Start  contact -->
                        <div class="col-md-6">
                            <div class="form contact-form">
                                <form action="{{ route('kontak') }}" method="post" role="form" class="php-email-form">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Nama" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            placeholder="No. Handhpone" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group mt-3">
                                        <textarea class="form-control" name="message" rows="5" placeholder="Pesan"></textarea>
                                    </div>
                                    <div class="my-3">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>
                                    </div>
                                    <div class="text-center"><button type="submit">Kirim Pesan</button></div>
                                </form>
                            </div>
                        </div>
                        <!-- End Left contact -->
                    </div>
                </div>
            </div>
        </div><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection

@section('additional')
@endsection
