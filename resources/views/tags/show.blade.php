<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>{{ $tag->name }} - {{ config('app.name', 'Markedia') }}</title>
    <meta name="keywords" content="{{ $tag->name }}, blog, posts">
    <meta name="description" content="Posts tagged with {{ $tag->name }}">
    
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet">
    <link href="{{ asset('css/version/marketing.css') }}" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        
        <!-- Header -->
        <header class="market-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('images/version/market-logo.png') }}" alt="Markedia">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tags.index') }}">Tags</a></li>
                            <li class="nav-item"><a class="nav-link" href="">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="">Contact Us</a></li>
                        </ul>
                        <form class="form-inline" action="" method="GET">
                            <input class="form-control mr-sm-2" type="text" name="q" placeholder="Search..." value="{{ request('q') }}">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Page Title -->
        <div class="page-title db">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <h2>
                            <i class="fa fa-tag"></i> {{ $tag->name }}
                            <small class="hidden-xs-down hidden-sm-down">
                                {{ $tag->description ?? 'Posts tagged with ' . $tag->name }}
                            </small>
                        </h2>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tags.index') }}">Tags</a></li>
                            <li class="breadcrumb-item active">{{ $tag->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="section lb">
            <div class="container">
                <div class="row">
                    
                    <!-- Posts Column -->
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-custom-build">

                                @forelse($posts as $post)
                                    <div class="blog-box wow fadeIn">
                                        <div class="post-media">
                                            <a href="{{ route('posts.single', $post->slug) }}" title="{{ $post->title }}">
                                                <img src="{{ $post->thumbnail ? asset('uploads/' . $post->thumbnail) : asset('no-image.png') }}"
                                                    alt="{{ $post->title }}" class="img-fluid">
                                                <div class="hovereffect"><span></span></div>
                                            </a>
                                        </div>
                                        <div class="blog-meta big-meta text-center">
                                            
                                            <div class="post-sharing">
                                                <ul class="list-inline">
                                                    <li>
                                                        <a href="https://facebook.com/sharer/sharer.php?u={{ url()->current() }}" 
                                                           class="fb-button btn btn-primary" target="_blank">
                                                            <i class="fa fa-facebook"></i> Share
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($post->title) }}" 
                                                           class="tw-button btn btn-primary" target="_blank">
                                                            <i class="fa fa-twitter"></i> Tweet
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <h4>
                                                <a href="{{ route('posts.single', $post->slug) }}">{{ $post->title }}</a>
                                            </h4>
                                            <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                            
                                            <small>
                                                <a href="{{ route('categories.single', $post->category->slug) }}">
                                                    <i class="fa fa-folder"></i> {{ $post->category->title }}
                                                </a>
                                            </small>
                                            <small><i class="fa fa-calendar"></i> {{ $post->created_at->format('d F, Y') }}</small>
                                            <small><i class="fa fa-user"></i> by {{ $post->user->name ?? 'Admin' }}</small>
                                            <small><i class="fa fa-eye"></i> {{ $post->views ?? 0 }}</small>

                                            @if($post->tags->isNotEmpty())
                                                <div class="post-tags mt-2">
                                                    @foreach($post->tags->take(3) as $tagItem)
                                                        <a href="{{ route('tags.show', $tagItem->slug) }}" 
                                                           class="badge badge-secondary mr-1">
                                                            {{ $tagItem->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="invis">
                                @empty
                                    <div class="alert alert-info text-center py-4">
                                        <h4><i class="fa fa-info-circle"></i> Посты с этим тегом пока не найдены</h4>
                                    </div>
                                @endforelse

                            </div>
                        </div>

                        <!-- Pagination -->
                        <hr class="invis">
                        <div class="row">
                            <div class="col-md-12">
                                {{ $posts->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            
                            <!-- Newsletter -->
                            <div class="widget-no-style">
                                <div class="newsletter-widget text-center">
                                    <h3>Subscribe Today!</h3>
                                    <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                                    <form class="form-inline" method="post" action="">
                                        @csrf
                                        <input type="email" name="email" placeholder="Add your email here.." 
                                               required class="form-control" />
                                        <input type="submit" value="Subscribe" class="btn btn-default btn-block" />
                                    </form>
                                </div>
                            </div>

                            <div class="widget">
                                <h2 class="widget-title">Recent Posts</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between d-flex">
                                                <img src="{{ asset('upload/small_07.jpg') }}" alt="" class="img-fluid float-left mr-3" style="width: 70px;">
                                                <h5 class="mb-1">Beautiful buildings you need to see</h5>
                                                <small>12 Jan, 2024</small>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between d-flex">
                                                <img src="{{ asset('upload/small_08.jpg') }}" alt="" class="img-fluid float-left mr-3" style="width: 70px;">
                                                <h5 class="mb-1">Creative life introduction</h5>
                                                <small>11 Jan, 2024</small>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between d-flex">
                                                <img src="{{ asset('upload/small_09.jpg') }}" alt="" class="img-fluid float-left mr-3" style="width: 70px;">
                                                <h5 class="mb-1">Most beautiful sea in the world</h5>
                                                <small>07 Jan, 2024</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Advertising -->
                            <div class="widget">
                                <h2 class="widget-title">Advertising</h2>
                                <div class="banner-spot clearfix">
                                    <img src="{{ asset('upload/banner_03.jpg') }}" alt="Ad" class="img-fluid">
                                </div>
                            </div>

                            <!-- Popular Tags - СТАТИЧЕСКИЙ СПИСОК -->
                            <div class="widget">
                                <h2 class="widget-title">Popular Tags</h2>
                                <div class="link-widget">
                                    <div class="d-flex flex-wrap">
                                        <a href="#" class="badge badge-primary m-1 py-2 px-3" style="font-size: 0.9rem;">Laravel <span class="badge badge-light ml-1">21</span></a>
                                        <a href="#" class="badge badge-primary m-1 py-2 px-3" style="font-size: 0.9rem;">PHP <span class="badge badge-light ml-1">15</span></a>
                                        <a href="#" class="badge badge-primary m-1 py-2 px-3" style="font-size: 0.9rem;">Blog <span class="badge badge-light ml-1">31</span></a>
                                        <a href="#" class="badge badge-primary m-1 py-2 px-3" style="font-size: 0.9rem;">SEO <span class="badge badge-light ml-1">22</span></a>
                                        <a href="#" class="badge badge-primary m-1 py-2 px-3" style="font-size: 0.9rem;">Marketing <span class="badge badge-light ml-1">18</span></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Categories - СТАТИЧЕСКИЙ СПИСОК -->
                            <div class="widget">
                                <h2 class="widget-title">Categories</h2>
                                <div class="link-widget">
                                    <ul>
                                        <li><a href="#">Marketing <span>(21)</span></a></li>
                                        <li><a href="#">SEO Service <span>(15)</span></a></li>
                                        <li><a href="#">Digital Agency <span>(31)</span></a></li>
                                        <li><a href="#">Make Money <span>(22)</span></a></li>
                                        <li><a href="#">Blogging <span>(66)</span></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <br><br>
                        <div class="copyright">
                            &copy; {{ date('Y') }} {{ config('app.name', 'Markedia') }}. 
                            Design: <a href="http://html.design">HTML Design</a>.
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <div class="dmtop">Scroll to Top</div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/animate.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>