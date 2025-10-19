@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ isset($blog) ? 'Edit Blog Post' : 'Create Blog Post' }}</h5>
    </div>

    <div class="card-body">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ isset($blog) ? route('blog.update', $blog->id) : route('blog.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($blog)) @method('PATCH') @endif

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" rows="6" class="form-control" required>{{ old('content', $blog->content ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label>Meta Title</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blog->meta_title ?? '') }}">
            </div>

            <div class="mb-3">
                <label>Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label>Meta Keywords</label>
                <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}">
            </div>

            <div class="mb-3">
                <label>Featured Image</label>
                <input type="file" name="featured_image" class="form-control">
                @if(isset($blog) && $blog->featured_image)
                    <img src="{{ asset($blog->featured_image) }}" width="100" class="mt-2">
                @endif
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="0" {{ (old('status', $blog->status ?? 0) == 0) ? 'selected' : '' }}>Draft</option>
                    <option value="1" {{ (old('status', $blog->status ?? 0) == 1) ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($blog) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
</div>
@endsection
