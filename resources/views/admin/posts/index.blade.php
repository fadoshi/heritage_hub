@extends('layouts.dashboard')

@section('pageheader', 'Manage Post')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <a href="{{route('admin_posts_create')}}"
                class="d-none d-sm-inline-block btn btn-md btn-primary shadow-md text-white">
                Create New Post
            </a>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">List of all published posts</h5>
        
                      <!-- Table with hoverable rows -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Title</th>
                            <th colspan="3">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td scope="row">{{ $post->updated_at->format('F d, Y') }}</td>
                                <td scope="row">{{ $post->title }}</td>
                                <td scope="row"><a href="{{route('admin_posts_edit', $post)}}" class="edit">Edit</a></td>
                                <td scope="row">
                                    <form onsubmit="return confirm('Please confirm you want to delete! {{ $post->title }}');"
                                        method="POST" action="{{route('admin_posts_delete', $post)}}" id="delete-post" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                        <button form="delete-post" class="btn text-danger" style="text-decoration: underline">Delete</button>
                                    </form>
                                </td>
                                <td><a href="{{route('blog', $post)}}" class="view">View</a></td>
                                </td>
                            </tr>                            
                        @endforeach
                        </tbody>
                      </table>
                      <!-- End Table with hoverable rows -->
        
                    </div>
                  </div>
            </div>
        </div>
    </section>
    
    {{-- <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align:center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Title</th>
                        <th colspan="3">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Title</th>
                        <th colspan="3">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td scope="row">{{ $post->created_at->format('F d, Y') }}</td>
                            <td scope="row">{{ $post->title }}</td>
                            <td scope="row"><a href="{{route('admin_posts_edit', $post)}}" class="edit">Edit</a></td>
                            <td scope="row">
                                <button form="delete-post" class="btn text-danger"
                                    style="text-decoration: underline">Delete</button>
                                    <form onsubmit="return confirm('Please confirm you want to delete! {{ $post->title }}');"
                                        method="POST" action="" id="delete-post" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                            </td>
                            <td><a href="" class="view">View</a></td>
                            </td>
                        </tr>                            
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}
</div>
@endsection
