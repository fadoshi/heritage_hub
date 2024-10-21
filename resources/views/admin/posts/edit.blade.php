@extends('layouts.dashboard')

@section('pageheader', 'Edit Selected Post')

@section('content')
<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Title and Body is required</h5>

                <!-- Vertical Form -->
                <form class="row g-3" action="{{ route('admin_posts_update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="col-12">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="body" class="form-label">Body</label>
                        <!-- TinyMCE Editor class="tinymce-editor"-->
                        <textarea class="tinymce-editor" name="body" required>{{ $post->body }}</textarea><!-- End TinyMCE Editor -->
                    </div>
                    <div class="col-12">
                        <label for="image" class="form-label">Currently stored thumbnail</label>
                        @if ($post->image)
                        <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="img-thumbnail"
                            width="300">
                        @else
                        <p>No image available.</p>
                        @endif                        
                    </div>
                    <div class="col-12">
                        <label for="image" class="form-label">Update thumbnail</label>
                        <input type="file" id="image" name="image" class="form-control">
                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="tags"class="form-label">Available Tags</label>
                        <select class="form-control w-25" size="3" id="tags" name="tags[]" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit New Post</button>
                        <a class=" btn btn-secondary" href="{{ route('admin_posts_index') }}">
                            Cancel
                        </a>
                    </div>
                </form><!-- Vertical Form -->

            </div>
        </div>

    </div>

</section>
@endsection