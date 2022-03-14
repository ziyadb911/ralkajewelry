@extends('layouts.master')

@section('head')
@endsection

@section('jsready')
  $('#formCari').submit(function (e) {
    $('#formCari').find('input').each(function() {
        var input = $(this);
        if (!input.val() || input.val() == "") {
            input.prop('disabled', true);
        }
    });
  });
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
                  <h1 class="title2">Kumpulan Artikel</h1>
                </div>
                {{-- <div class="layer3">
                  <h2 class="title3">Baca Kumpulan Artikel Menarik Disini</h2>
                </div> --}}
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
          <div class="col-md-8 col-sm-8 col-sm-12 col-xs-12">
            @if(request()->hasAny(['cari', 'kategori', 'tag']))
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <h6>
                    @if(request()->has('cari'))
                      Artikel dengan Pencarian '{{ request()->get('cari') }}'
                    @elseif(request()->has('kategori'))
                      Artikel dengan Kategori '{{ count($articleCategories) > 0 ? ($articleCategories->firstWhere('id', request()->get('kategori'))->name ?? '') : '' }}'
                    @elseif(request()->has('tag'))
                      Artikel dengan Tag '{{ count($tags) > 0 ? ($tags->firstWhere('id', request()->get('tag'))->name ?? '') : '' }}'
                    @endif
                  </h6>
                </div>
              </div>
            @endif
            <div class="row">
              @if (count($articles) > 0)
                @foreach ($articles as $article)
                  <!-- Start single blog -->
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="single-blog">
                      <div class="single-blog-img">
                        <a href="{{ route('artikel.detail', ['article' => $article]) }}">
                          <img src="{{ URL::asset($article->image_url) }}" alt="">
                        </a>
                      </div>
                      <div class="blog-meta">
                        <span class="comments-type">
                          <i class="bi bi-clock"></i> {{ $article->date_indo }}
                        </span>
                        <span class="comments-type">
                          <i class="bi bi-folder"></i> <a href="{{ route('artikel', ['kategori' => $article->articleCategory]) }}">{{ $article->articleCategory->name ?? '' }}</a>
                        </span>
                        @if(isset($article->tags) && count($article->tags) > 0)
                          <span class="comments-type"><i class="bi bi-tags"></i>
                            @foreach ($article->tags as $tag)
                              <a href="{{ route('artikel', ['tag' => $tag]) }}">{{ $tag->name ?? '' }}</a>{{ (!$loop->last) ? '|' : '' }}
                            @endforeach
                          </span>
                        @endif
                      </div>
                      <div class="blog-text">
                        <h4>
                          <a href="{{ route('artikel.detail', ['article' => $article]) }}">{{ $article->title ?? '' }}</a>
                        </h4>
                        {!! (strlen($article->content) > 250) ? (substr($article->content, 0, 250) . '...') : $article->content !!}
                      </div>
                      <span>
                        <a href="{{ route('artikel.detail', ['article' => $article]) }}" class="ready-btn">Baca Selengkapnya</a>
                      </span>
                    </div>
                  </div>
                  <!-- End single blog -->
                  @endforeach
                  <div class="blog-pagination mb-3">
                    <ul class="pagination">
                      <li class="page-item"><a href="#" class="page-link">&lt;</a></li>
                      <li class="page-item active"><a href="#" class="page-link">1</a></li>
                      <li class="page-item"><a href="#" class="page-link">2</a></li>
                      <li class="page-item"><a href="#" class="page-link">3</a></li>
                      <li class="page-item"><a href="#" class="page-link">&gt;</a></li>
                    </ul>
                  </div>
              @else
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <h5>
                    @if(request()->has('cari'))
                      Tidak ditemukan artikel dengan pencarian tersebut
                    @elseif(request()->has('kategori'))
                      Tidak ditemukan artikel dengan kategori tersebut
                    @elseif(request()->has('tag'))
                      Tidak ditemukan artikel dengan tag tersebut
                    @else
                      Tidak ada artikel yang terdaftar
                    @endif
                  </h5>
                </div>
              @endif
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="page-head-blog">
              <div class="single-blog-page">
                <!-- search option start -->
                <form method='GET' action="" id="formCari">
                  <div class="search-option">
                    <input type="text" name="cari" id="cari" placeholder="Cari..." value="{{ request()->get('cari') ?? '' }}">
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
              @if (count($articleCategories) > 0)
                <div class="single-blog-page">
                  <div class="left-blog">
                    <h4>Kategori</h4>
                    <ul>
                      @foreach ($articleCategories as $articleCategory)
                        <li>
                          <a href="{{ route('artikel', ['kategori' => $articleCategory]) }}">{{ $articleCategory->name ?? '' }}</a>
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
                            <a href="{{ route('artikel', ['tag' => $tag]) }}">{{ $tag->name ?? '' }}</a>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Blog Page -->

  </main><!-- End #main -->
@endsection

@section('additional')
@endsection