@extends('layouts.dashboard')

@section('pageheader', 'Create New Post')

@section('content')
    <section class="section">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Title and Body is required</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('admin_posts_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="body" class="form-label">Body</label>
                            <!-- TinyMCE Editor class="tinymce-editor"-->
                            <textarea class="tinymce-editor" name="body" required>Post content goes here..</textarea><!-- End TinyMCE Editor -->
                        </div>
                        <div class="col-12">
                            <label for="image" class="form-label">Thumbnail</label>
                            <input type="file" id="image" name="image" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="tags"class="form-label">Available Tags</label>
                            <select class="form-control w-25" size="3" id="tags" name="tags[]" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit New Post</button>
                            <a class=" btn btn-secondary" href="{{ route('admin_post_index') }}">
                                Cancel
                            </a>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>

        </div>

    </section>
@endsection
