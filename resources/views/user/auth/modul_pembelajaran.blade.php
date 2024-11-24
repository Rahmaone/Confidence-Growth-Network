@extends('user.auth.layout.app')

@section('page-specific-css')
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="{{ asset('User-depan/css/style_login.css')}}">

@endsection


@push('styles')
    <style>
        .blog-item-img {
            width: 100%;
            height: 250px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .blog-item-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    </style>
@endpush

@section('content')

    <div class="site-breadcrumb" style="background: url({{ url('images/breadcrumb/07.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">Blog</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li class="active">Blog</li>
            </ul>
        </div>
    </div>

    <div class="blog-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Our Blog</span>
                        <h2 class="site-title">Artikel dan Berita & <span>Terbaru</span></h2>
                    </div>
                </div>
            </div>

            @if ($blogs->isEmpty())
                <div class="col-md-12">
                    <div class="alert alert-warning text-center" role="alert">
                        <strong>Maaf!</strong> Data blog belum tersedia.
                    </div>
                </div>
            @endif

            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="blog-date">
                                <i class="fal fa-calendar-alt"></i> {{ $blog->created_at->format('d M Y') }}
                            </div>
                            <div class="blog-item-img text-center">
                                <img src="{{ $blog && $blog->photo ? url('images/blogs/' . $blog->photo) : url('assets/admin/images/no-img-avatar.png') }}"
                                    alt />
                            </div>
                            <div class="blog-item-info">
                                <div class="blog-item-meta">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="far fa-user-circle"></i>
                                                {{ $blog->user->name }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h4 class="blog-title">
                                    <a href="{{ url('blogs/' . $blog->slug) }}">{{ $blog->title }}</a>
                                </h4>
                                <a class="theme-btn" href="{{ url('blogs/' . $blog->slug) }}">Selengkapnya<i
                                        class="fas fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-area">
                <div aria-label="Page navigation example">
                    @if ($blogs->isEmpty() == false)
                        <ul class="pagination">
                            @if ($blogs->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true"><i class="far fa-arrow-left"></i></span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $blogs->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true"><i class="far fa-arrow-left"></i></span>
                                    </a>
                                </li>
                            @endif

                            @foreach ($blogs->links()->elements[0] as $page => $url)
                                @if ($page == $blogs->currentPage())
                                    <li class="page-item active">
                                        <a class="page-link" href="#">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($blogs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $blogs->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true"><i class="far fa-arrow-right"></i></span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true"><i class="far fa-arrow-right"></i></span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection
