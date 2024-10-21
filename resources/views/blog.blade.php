@extends('layouts.home')

@section('content')
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{ $post->title}}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on {{$post->created_at->format('F d, Y')}} by {{$post->user->first_name}} {{$post->user->last_name}}</div>
                    <!-- Post categories-->
                    @foreach ($post->tags as $tag)
                        <a class="badge bg-secondary text-decoration-none link-light" href="#">{{ $tag->name }}</a>
                    
                    @endforeach
                    
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4">
                    <img class="card-img-top rounded" 
                        src="{{ asset('images/' . $post->image) ?? 'https://dummyimage.com/700x350/dee2e6/6c757d.jpg' }}"
                        alt="{{ $post->title }}" 
                    />
                </figure>
                <!-- Post content-->
                <section class="mb-5">
                    {{$post->body}}
                    {{-- <p class="fs-5 mb-4">Science is an enterprise that should be cherished as an activity of the free human mind. Because it transforms who we are, how we live, and it gives us an understanding of our place in the universe.</p>
                    <p class="fs-5 mb-4">Venus has a runaway greenhouse effect. I kind of want to know what happened there because we're twirling knobs here on Earth without knowing the consequences of it. Mars once had running water. It's bone dry today. Something bad happened there as well.</p> --}}
                </section>
            </article>
            <!-- Comments section-->
            {{-- <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                        <!-- Comment with nested comments-->
                        <div class="d-flex mb-4">
                            <!-- Parent comment-->
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">Commenter Name</div>
                                If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                <!-- Child comment 1-->
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                    </div>
                                </div>
                                <!-- Child comment 2-->
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        When you put money directly to a problem, it makes a good headline.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single comment-->
                        <div class="d-flex">
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">Commenter Name</div>
                                When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
        </div>
        <!-- Side widgets-->
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

            
            
        </div>
    </div>
</div>
@endsection