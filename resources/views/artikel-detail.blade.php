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
                {{-- <div class="layer2">
                  <h1 class="title2">Artikel</h1>
                </div> --}}
                <div class="layer3">
                  <h2 class="title3">{{ $article->title }}</h2>
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
              @if(count($recentArticles) > 0)
                <div class="single-blog-page">
                  <!-- recent start -->
                  <div class="left-blog">
                    <h4>Artikel Terbaru</h4>
                    <div class="recent-post">
                      @foreach ($recentArticles as $recentArticle)
                        <!-- start single post -->
                        <div class="recent-single-post">
                          <div class="post-img">
                            <a href="{{ route('artikel.detail', ['article' => $recentArticle]) }}">
                              <img src="{{ URL::asset($recentArticle->image_url ?? 'img/image-default.jpg') }}" alt="{{ $recentArticle->title }}">
                            </a>
                          </div>
                          <div class="pst-content">
                            <p><a href="{{ route('artikel.detail', ['article' => $recentArticle]) }}">{{ $recentArticle->title }}</a></p>
                          </div>
                        </div>
                        <!-- End single post -->    
                      @endforeach
                    </div>
                  </div>
                  <!-- recent end -->
                </div>
              @endif
            </div>
          </div>
          <!-- End left sidebar -->
          <!-- Start single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- single-blog start -->
                <article class="blog-post-wrapper">
                  <div class="post-thumbnail">
                    <img src="{{ URL::asset($article->image_url) }}" alt="">
                  </div>
                  <div class="post-information">
                    @if(isset($article->subtitle) && $article->subtitle != '')
                      <h2>{{ $article->subtitle ?? '' }}</h2>
                    @endif
                    <div class="entry-meta">
                      <span><i class="bi bi-person"></i>{{ $article->userCreate->name ?? '' }}</span>
                      <span><i class="bi bi-clock"></i>{{ $article->date_indo ?? '' }}</span>
                      <span><i class="bi bi-folder"></i><a href="{{ route('artikel', ['kategori' => $article->articleCategory]) }}">{{ $article->articleCategory->name ?? '' }}</a></span>
                      @if(isset($article->tags) && count($article->tags) > 0)
                        <span><i class="bi bi-tags"></i>
                          @foreach ($article->tags as $tag)
                            <a href="{{ route('artikel', ['tag' => $tag]) }}">{{ $tag->name ?? '' }}</a>{{ (!$loop->last) ? ',' : '' }}
                          @endforeach
                        </span>
                      @endif
                    </div>
                    <div class="entry-content">
                     {!! $article->content !!}
                    </div>
                  </div>
                </article>
                <!-- single-blog end -->
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