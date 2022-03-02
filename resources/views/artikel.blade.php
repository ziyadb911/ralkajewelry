@extends('layouts.master')

@section('head')
@endsection

@section('jsready')
@endsection

@section('jsfunction')
@endsection

@section('content')
  <main id="main">

    <!-- ======= Blog Header ======= -->
    <div class="header-bg page-area">
      <div class="container position-relative">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="slider-content text-center">
              <div class="header-bottom">
                <div class="layer2">
                  <h1 class="title2">My Blog</h1>
                </div>
                <div class="layer3">
                  <h2 class="title3">Profesional Blog Page</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Blog Header -->

    <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="page-head-blog">
              <div class="single-blog-page">
                <!-- search option start -->
                <form action="#">
                  <div class="search-option">
                    <input type="text" placeholder="Search...">
                    <button class="button" type="submit">
                      <i class="bi bi-search"></i>
                    </button>
                  </div>
                </form>
                <!-- search option end -->
              </div>
              @if (count($recentArticles) > 0)
                <div class="single-blog-page">
                  <!-- recent start -->
                  <div class="left-blog">
                    <h4>Artikel Terbaru</h4>
                    <div class="recent-post">
                      @foreach ($recentArticles as $article)
                        <!-- start single post -->
                        <div class="recent-single-post">
                          <div class="post-img">
                            <a href="#">
                              <img src="{{ URL::asset($article->image_url ?? 'img/image-default.jpg') }}" alt="{{ $article->title }}">
                            </a>
                          </div>
                          <div class="pst-content">
                            <p><a href="#">{{ $article->title }}</a></p>
                          </div>
                        </div>
                        <!-- End single post -->    
                      @endforeach
                    </div>
                  </div>
                  <!-- recent end -->
                </div>
              @endif
              @if (count($articleCategories) > 0)
                <div class="single-blog-page">
                  <div class="left-blog">
                    <h4>Kategori</h4>
                    <ul>
                      @foreach ($articleCategories as $articleCategory)
                        <li>
                          <a href="#">{{ $articleCategory->name ?? '' }}</a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              @endif
              @if (count($tags) > 0)
                <div class="single-blog-page">
                  <div class="left-tags blog-tags">
                    <div class="popular-tag left-side-tags left-blog">
                      <h4>tag</h4>
                      <ul>
                        @foreach ($tags as $tag)
                          <li>
                            <a href="#">{{ $tag->name ?? '' }}</a>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <!-- End left sidebar -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
              @if (count($articles) > 0)
                @foreach ($articles as $article)
                  <!-- Start single blog -->
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="single-blog">
                      <div class="single-blog-img">
                        <a href="blog-details.html">
                          <img src="{{ $article->image_url }}" alt="">
                        </a>
                      </div>
                      <div class="blog-meta">
                        <span class="date-type">
                          <i class="bi bi-calendar"></i>28 Maret 2018
                        </span>
                        <span class="date-type">
                          <i class="bi bi-folder"></i>{{ $article->articleCategory->name ?? '' }}
                        </span>
                        <span class="date-type">
                          <i class="bi bi-tags"></i>{{ $article->articleCategory->name ?? '' }}
                        </span>
                      </div>
                      <div class="blog-text">
                        <h4>
                          <a href="#">{{ $article->title ?? '' }}</a>
                        </h4>
                        {!! $article->content ?? '' !!}
                      </div>
                      <span>
                        <a href="blog-details.html" class="ready-btn">Read more</a>
                      </span>
                    </div>
                  </div>
                  <!-- End single blog -->
                @endforeach
              @endif
              <div class="blog-pagination">
                <ul class="pagination">
                  <li class="page-item"><a href="#" class="page-link">&lt;</a></li>
                  <li class="page-item active"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">&gt;</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Blog Page -->

  </main><!-- End #main -->
@endsection

@section('additional')
@endsection