@extends('user.auth.layout.app')

@section('page-specific-css')
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="{{ asset('User-depan/css/style_login.css')}}">

@endsection

    <div class="site-breadcrumb" style="background: url({{ url('images/breadcrumb/07.jpg') }})">
        <div class="container">
            <h2 class="breadcrumb-title">{{ $blog->title }}</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li class="active">Blog</li>
            </ul>
        </div>
    </div>

    <div class="blog-single-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-single-wrapper">
                        <div class="blog-single-content">
                            <div class="blog-thumb-img text-center">
                                <img src="{{ $blog && $blog->photo ? url('images/blogs/' . $blog->photo) : url('assets/admin/images/no-img-avatar.png') }}"
                                    alt="thumb" />
                            </div>
                            <div class="blog-info">
                                <div class="blog-meta">
                                    <div class="blog-meta-left">
                                        <ul>
                                            <li>
                                                <i class="far fa-user"></i><a href="#">
                                                    {{ $blog->user->name }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="blog-meta-right">
                                        <a href="#" class="share-link"><i class="far fa-share-alt"></i>Share</a>
                                    </div>
                                </div>
                                <div class="blog-details">
                                    <h3 class="blog-details-title mb-20">
                                        {{ $blog->title }}
                                    </h3>

                                    <p>
                                        {!! $blog->content !!}
                                    </p>

                                    <hr />
                                </div>
                                <div class="blog-author">
                                    <div class="blog-author-img">
                                        <img src="{{ Auth::user() && Auth::user()->profile_picture ? url('images/users/' . Auth::user()->profile_picture) : url('images/avatar-placeholder.jpg') }}"
                                            alt />
                                    </div>
                                    <div class="author-info">
                                        <h6>Penulis</h6>
                                        <h3 class="author-name">{{ $blog->user->name }}</h3>
                                        <p>
                                            Seorang individu kreatif dan dinamis yang memiliki passion untuk berbagi
                                            pengetahuan, pengalaman, dan inspirasi. Tertarik dengan berbagai bidang dan
                                            selalu haus akan pembelajaran baru.
                                        </p>
                                        <div class="author-social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-whatsapp"></i></a>
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar">
                        <div class="widget search">
                            <h5 class="widget-title">Cari</h5>
                            <form class="search-form">
                                <input type="text" class="form-control" placeholder="Cari Disini..." />
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>

                        <div class="widget category">
                            <h5 class="widget-title">Kategori</h5>
                            <div class="category-list">
                                @foreach ($blog_categories as $category)
                                    <a href="#"><i class="far fa-arrow-right"></i>{{ $category->name }}
                                        <span>({{ $category->blogs->count() }})</span></a>
                                @endforeach
                            </div>
                        </div>

                        <div class="widget recent-post">
                            <h5 class="widget-title">Terbaru</h5>
                            @foreach ($recent_blogs as $recent_blog)
                                <div class="recent-post-single">
                                    <div class="recent-post-img">
                                        <img src="{{ $recent_blog && $recent_blog->photo ? url('images/blogs/' . $recent_blog->photo) : url('assets/admin/images/no-img-avatar.png') }}"
                                            alt="thumb" />
                                    </div>
                                    <div class="recent-post-bio">
                                        <h6>
                                            <a
                                                href="{{ url('blogs/' . $recent_blog->slug) }}">{{ $recent_blog->title }}</a>
                                        </h6>
                                        <span><i
                                                class="far fa-clock"></i>{{ $recent_blog->created_at->format('F d, Y') }}</span>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="widget social-share">
                            <h5 class="widget-title">Ikuti Kami</h5>
                            <div class="social-share-link">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>


                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
