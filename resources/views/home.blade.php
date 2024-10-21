@extends('layouts.home')

@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Heritage Hub!</h1>
            <p class="lead mb-0">Rich tapestry of our culture, traditions, and rituals</p>
        </div>

        <section class="section">
            <div class="row align-items-top">
                <div class="col-lg-8">
                    <!-- Card with an image on left -->
                    @foreach ($posts as $key => $post)
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img class="img-fluid rounded-start"
                                        src="{{ asset('images/' . $post->image) ?? 'https://dummyimage.com/700x350/dee2e6/6c757d.jpg' }}"
                                        alt="{{ $post->title }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ Str::limit($post->body, 150) }}</p>
                                        <a class="btn btn-primary" href="{{route('blog', $post)}}">Read more
                                            →</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Card with an image on left -->
                    @endforeach
                </div>

                <div class="col-lg-4">

                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Search</h4>
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..."
                                    aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Badge widget-->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Categories</h4>

                            @foreach ($tags->take(ceil($tags->count())) as $tag)
                                <span class="badge bg-primary">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div><!-- End Default Badges -->

                    <!-- Side widget-->
                    <div class="card mb-4">
                        
                        <div class="card-body">
                            <h4 class="card-title">Side Widget</h4>
                            <p>You can put anything you want inside of these side widgets. They are easy to
                            use, and feature the Bootstrap 5 card component!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Basic Pagination -->
                <nav aria-label="Page navigation example">
                    
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
        @if ($posts->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $posts->previousPageUrl() }}">Previous</a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($posts->links()->elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $posts->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($posts->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $posts->nextPageUrl() }}">Next</a>
        </li>
    @else
        <li class="page-item disabled">
            <a class="page-link" href="#" aria-disabled="true">Next</a>
        </li>
    @endif
                    </ul>
                </nav><!-- End Basic Pagination -->
            </div>

        </section>

    </div>
@endsection
