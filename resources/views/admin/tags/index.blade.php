@extends('layouts.dashboard')

@section('pageheader', 'Manage Post')

@section('content')

    <div class="card shadow mb-4">

        <div class="card-body">
            <h5 class="card-title">Create a new tag</h5>
            <form action="{{ route('admin_tags_store') }}" method="POST" id="tag-form">
                @csrf
                <div class="row mb-3">
                    <label for="tag-name" class="col-md-2 col-form-label">Tag Name:</label>
                    <div class="col-md-10">
                        <input type="text" id="tag-name" name="name" class="form-control" required>
                    </div>
                    @error('tag-name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-sm-flex align-item-center justify-content-end">
                    <button form="tag-form" type="submit" class="btn btn-primary">Save New Tag</button>
                </div>
            </form>
        </div>


    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List of all available tags</h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th colspan="2"> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td scope="row">{{ $tag->name }}</td>
                                        <td scope="row"><a href="" class="">Edit</a></td>
                                        <td scope="row">
                                            <form onsubmit="return confirm('Please confirm you want to delete the tag: {{ $tag->name }}');"
                                                method="POST" action="{{ route('admin_tags_delete', $tag) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn text-danger" style="text-decoration: underline">Delete</button>
                                            </form>
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

@endsection
