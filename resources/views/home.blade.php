@extends('layouts.master')

@section('head')
@endsection

@section('jsready')
    let forms = document.querySelectorAll('.php-email-form');

    forms.forEach(function (e) {
        e.addEventListener('submit', function (event) {
            event.preventDefault();

            let thisForm = this;

            let action = thisForm.getAttribute('action');
            let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');

            if (!action) {
                displayError(thisForm, 'The form action property is not set!')
                return;
            }
            thisForm.querySelector('.loading').classList.add('d-block');
            thisForm.querySelector('.error-message').classList.remove('d-block');
            thisForm.querySelector('.sent-message').classList.remove('d-block');

            let formData = new FormData(thisForm);

            if (recaptcha) {
                if (typeof grecaptcha !== "undefined") {
                grecaptcha.ready(function () {
                    try {
                    grecaptcha.execute(recaptcha, { action: 'php_email_form_submit' })
                        .then(token => {
                        formData.set('recaptcha-response', token);
                        php_email_form_submit(thisForm, action, formData);
                        })
                    } catch (error) {
                    displayError(thisForm, error)
                    }
                });
                } else {
                displayError(thisForm, 'The reCaptcha javascript API url is not loaded!')
                }
            } else {
                php_email_form_submit(thisForm, action, formData);
            }
        });
    });
@endsection

@section('jsfunction')
    function php_email_form_submit(thisForm, action, formData) {
        fetch(action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => {
            if (response.ok) {
                thisForm.querySelector('.loading').classList.remove('d-block');
                thisForm.querySelector('.sent-message').classList.add('d-block');
                thisForm.reset();
            } else {
                console.error(response.text());
                throw new Error('Terjadi kesalahan saat mengirim data, silahkan coba lagi');
            }
        })
        .catch((error) => {
            displayError(thisForm, error);
        });
    }

    function displayError(thisForm, error) {
        thisForm.querySelector('.loading').classList.remove('d-block');
        thisForm.querySelector('.error-message').innerHTML = error;
        thisForm.querySelector('.error-message').classList.add('d-block');
    }
@endsection

@section('content')
    <!-- ======= hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

                <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">

                    <div class="carousel-item active" style="background-image: url({{ URL::asset('/img/hero-carousel/ring-blue') }}.jpg)">
                        <div class="carousel-container">
                            <div class="container">
                                <h2 class="animate__animated animate__fadeInDown">We build trust with you</h2>
                                <p class="animate__animated animate__fadeInUp" style="font-style: italic">Quality is what we focused on</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item" style="background-image: url({{ URL::asset('/img/hero-carousel/ring-blue') }}.jpg)">
                        <div class="carousel-container">
                            <div class="container">
                                <h2 class="animate__animated animate__fadeInDown">No fake diamonds here</h2>
                                <p class="animate__animated animate__fadeInUp" style="font-style: italic">Purity is our main purpose</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item" style="background-image: url({{ URL::asset('/img/hero-carousel/ring-blue') }}.jpg)">
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
                                    <img src="{{ URL::asset('/img/about/ring-blue.jpg') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- single-well end-->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="well-middle">
                            <div class="single-well">
                                <h4 class="sec-head">Ralka Jewelry</h4>
                                <p>
                                    Ralka Jewelry sebagai sarana online penyedia perhiasan berlian maupun batu permata yang ekonomis dan tentunya dengan tetap mempertahankan kualitas setiap koleksinya.
                                    Selain itu, Ralka Jewelry juga mengutamakan aspek Quality Control yang sangat ketat.
                                    Hal ini termasuk membuat rangka yang kuat, fokus pada detail, dan berinovasi dengan memproduksi model terkini.
                                    Ralka Jewelry juga menyediakan layanan pemesanan sesuai keinginan Anda, dan juga reparasi semua jenis perhiasan.
                                    
                                </p>
                                <p>
                                    Kami akan selalu mengembakan diri untuk menjadi yang terbaik.
                                    Dengan itu, Ralka Jewelry akan selalu melayani Anda dengan baik dan lebih baik lagi.
                                </p>
                                <h4 class="sec-head">WHY US ?</h4>
                                <p>
                                    It's simple, Karena Ralka Jewelry memiliki pengrajin yang professional dan perlengkapan yang canggih untuk mewujudkan perhiasan sesuai yang Anda inginkan.
                                </p>
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
                                        Ralka Jewelry menyediakan Custom perhiasan sesuai yang anda inginkan
                                        perak maupun emas, berlian ataupun batu permata.
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
                                        Ralka Jewelry dapat membantu anda untuk pencucian (chrome)
                                        perhiasan untuk tampak lebih baru. Kuning, rosegold, dan putih.
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
                                        Kami dapat membantu merubah ukuran perhiasan Anda sehingga ketika digunakan akan sesuai.
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
                                        Anda dapat memberi text pada perhiasan yang anda miliki.
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
                                        Ralka Jewelry dapat membantu anda dengan pengecekan Berlian yang anda miliki.
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
        <div class="reviews-area mb-5">
            <div class="row g-0">
                <div class="col-lg-6">
                    <img src="{{ URL::asset($company->invitation_image_url) }}" alt="" class="img-fluid">
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
                                <a href="#"><img class="galeri-img" src="{{ URL::asset('img/galeri/fancy-yellow-sapphire.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/galeri/fancy-yellow-sapphire.jpg') }}">
                                            <h4>Fancy Yellow Sapphire</h4>
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
                                <a href="#"><img class="galeri-img" src="{{ URL::asset('img/galeri/ruby-burma.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/galeri/ruby-burma.jpg') }}">
                                            <h4>Ruby Burma</h4>
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
                                <a href="#"><img class="galeri-img" src="{{ URL::asset('img/galeri/emerald-colombia.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/galeri/emerald-colombia.jpg') }}">
                                            <h4>Emerald Colombia</h4>
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
                                <a href="#"><img class="galeri-img" src="{{ URL::asset('img/galeri/yellow-sapphire.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/galeri/yellow-sapphire.jpg') }}">
                                            <h4>Yellow Sapphire</h4>
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
                                <a href="#"><img class="galeri-img" src="{{ URL::asset('img/galeri/pink-sapphire.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/galeri/pink-sapphire.jpg') }}">
                                            <h4>Pink Sapphire</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item filter-app">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img class="galeri-img" src="{{ URL::asset('img/galeri/fancy-sapphire.jpg') }}" alt="" /></a>
                                <div class="add-actions text-center text-center">
                                    <div class="project-dec">
                                        <a class="portfolio-lightbox" data-gallery="myGallery"
                                            href="{{ URL::asset('img/galeri/fancy-sapphire.jpg') }}">
                                            <h4>Fancy Sapphire</h4>
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
                                            <span class="comments-type">
                                                <i class="bi bi-clock"></i> {{ $recentArticle->date_indo }}
                                            </span>
                                            <span class="comments-type">
                                                <i class="bi bi-folder"></i> <a href="{{ route('artikel', ['kategori' => $recentArticle->articleCategory]) }}">{{ $recentArticle->articleCategory->name ?? '' }}</a>
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
                        {{-- <div class="col-md-6">
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
                        </div> --}}
                        <!-- End Google Map -->
                        <div class="col-md-3"></div>
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
                                        <div class="sent-message">Pesan anda berhasil dikirim. Terima kasih telah menghubungi kami!</div>
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
