<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>Markedia - Marketing Blog Template</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

<!-- Design fonts -->
    <link href="https://googleapis.com" rel="stylesheet"> 
    
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('style.css') }}" rel="stylesheet">

    <!-- Animate styles for this template -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet">

    <!-- Version Marketing CSS for this template -->
    <link href="{{ asset('css/version/marketing.css') }}" rel="stylesheet">

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <section class="section lb">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-custom-build">

                        @forelse($posts as $post)
                            <div class="blog-box wow fadeIn">
                                <div class="post-media">
                                    <a href="{{ route('posts.single', $post->slug) }}" title="">
                                        <img src="{{ $post->thumbnail ? asset('uploads/' . $post->thumbnail) : asset('no-image.png') }}"
                                            alt="{{ $post->title }}" class="img-fluid">
                                        <div class="hovereffect"><span></span></div>
                                    </a>
                                </div>
                                <div class="blog-meta big-meta text-center">
                                    <div class="post-sharing">
                                        <ul class="list-inline">
                                            <li><a href="https://facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share</span></a></li>
                                            <li><a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->title }}" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet</span></a></li>
                                        </ul>
                                    </div>
                                    <h4>
                                        <a href="{{ route('posts.single', $post->slug) }}">{{ $post->title }}</a>
                                    </h4>
                                    <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                    <small>
                                        <a href="{{ route('categories.single', $post->category->slug) }}">
                                            {{ $post->category->title }}
                                        </a>
                                    </small>
                                    <small>{{ $post->created_at->format('d F, Y') }}</small>
                                    <small>by {{ $post->user->name ?? 'Admin' }}</small>
                                    <small><i class="fa fa-eye"></i> {{ $post->views ?? 0 }}</small>
                                </div>
                            </div>
                            <hr class="invis">
                        @empty
                            <div class="alert alert-info text-center">
                                <h4>В этой категории пока нет постов</h4>
                            </div>
                        @endforelse

                    </div>
                </div>

                <hr class="invis">
                <div class="row">
                    <div class="col-md-12">
                        {{ $posts->withQueryString()->links() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget-no-style">
                        <div class="newsletter-widget text-center">
                            <h3>Subscribe Today!</h3>
                            <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                            <form class="form-inline" method="post" action="">
                                @csrf
                                <input type="email" name="email" placeholder="Add your email here.." required class="form-control" />
                                <input type="submit" value="Subscribe" class="btn btn-default btn-block" />
                            </form>
                        </div>
                    </div>

                    <div class="widget">
                        <h2 class="widget-title">Recent Posts</h2>
                        <div class="blog-list-widget">
                            <div class="list-group">
                                @foreach(\App\Models\Post::latest()->take(3)->get() as $recentPost)
                                    <a href="{{ route('posts.single', $recentPost->slug) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 justify-content-between">
                                            <img src="{{ $recentPost->thumbnail ? asset('storage/' . $recentPost->thumbnail) : asset('no-image.png') }}" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1">{{ Str::limit($recentPost->title, 40) }}</h5>
                                            <small>{{ $recentPost->created_at->format('d M, Y') }}</small>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="widget">
                        <h2 class="widget-title">Advertising</h2>
                        <div class="banner-spot clearfix">
                            <img src="{{ asset('upload/banner_03.jpg') }}" alt="Ad" class="img-fluid">
                        </div>
                    </div>

                    <div class="widget">
                        <h2 class="widget-title">Popular Categories</h2>
                        <div class="link-widget">
                            <ul>
                                @foreach(\App\Models\Category::withCount('posts')->orderBy('posts_count', 'desc')->take(7)->get() as $cat)
                                    <li>
                                        <a href="{{ route('categories.single', $cat->slug) }}">
                                            {{ $cat->title }} <span>({{ $cat->posts_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        <div class="dmtop">Scroll to Top</div>

    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/animate.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
