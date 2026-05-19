
@section('page-title')
<div class="page-title db">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2>Search: {{ $s }}</h2>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumbs">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Search</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="blog-custom-build">
        
        @if($posts->count())
            @foreach($posts as $post)
                <div class="blog-box wow fadeIn">
                    <div class="post-media">
                        <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">
                            <img src="{{ $post->thumbnail ? asset('uploads/' . $post->thumbnail) : asset('no-image.png') }}" 
                                 alt="{{ $post->title }}" class="img-fluid">
                            <div class="hovereffect">
                                <span></span>
                            </div>
                        </a>
                    </div>
                    <div class="blog-meta big-meta text-center">
                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> Share</a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> Tweet</a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                        <h4>
                            <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">
                                {{ $post->title }}
                            </a>
                        </h4>
                        {!! $post->description !!}
                        <small>
                            <a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}" title="">
                                {{ $post->category->title }}
                            </a>
                        </small>
                        <small>{{ $post->getPostDate() }}</small>
                        <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                    </div>
                </div>
                <hr class="invis">
            @endforeach
        @else
            {{-- Сообщение, если ничего не найдено --}}
            <div class="alert alert-warning text-center">
                По запросу <strong>"{{ $s }}"</strong> ничего не найдено...
            </div>
        @endif
        
    </div>
</div>

<hr class="invis">

{{-- Пагинация с сохранением параметра поиска --}}
<div class="row">
    <div class="col-md-12">
        <nav aria-label="Page navigation">
            {{ $posts->appends(['s' => request()->s])->links() }}
        </nav>
    </div>
</div>
@endsection