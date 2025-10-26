@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="m-0">{{ isset($blog) ? 'Edit Blog Post' : 'Create Blog Post' }}</h5>
        </div>

        <div class="card-body">
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

                <div class="row">

                    {{-- LEFT SECTION --}}
                    <div class="col-md-8">
                        <div class="card border mb-4">
                            <div class="card-header bg-light">
                                <h6 class="m-0 fw-bold text-primary">📰 Main Blog Information</h6>
                            </div>
                            <div class="card-body">

                                {{-- Title --}}
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" 
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ old('title', $blog->title ?? '') }}" required>
                                    @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                {{-- Slug --}}
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="slug" 
                                           class="form-control @error('slug') is-invalid @enderror"
                                           value="{{ old('slug', $blog->slug ?? '') }}">
                                    <small class="text-muted">Leave empty to auto-generate from title.</small>
                                    @error('slug') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                {{-- Content with Summernote --}}
                                <div class="mb-3">
                                    <label class="form-label">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" rows="8" 
                                              class="form-control aiz-text-editor @error('content') is-invalid @enderror"
                                              required>{{ old('content', $blog->content ?? '') }}</textarea>
                                    @error('content') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                {{-- Category --}}
                                <div class="mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                {{-- Featured Image --}}
                                <div class="mb-3">
                                    <label class="form-label">Featured Image @if(!isset($blog))<span class="text-danger">*</span>@endif</label>
                                    <input type="file" name="featured_image" 
                                           class="form-control @error('featured_image') is-invalid @enderror">
                                    @error('featured_image') <span class="invalid-feedback">{{ $message }}</span> @enderror

                                    @if(isset($blog) && $blog->featured_image)
                                        <img src="{{ asset($blog->featured_image) }}" width="120" class="mt-2 rounded shadow-sm border">
                                    @endif
                                </div>

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="0" {{ (old('status', $blog->status ?? 0) == 0) ? 'selected' : '' }}>Draft</option>
                                        <option value="1" {{ (old('status', $blog->status ?? 0) == 1) ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- RIGHT SECTION --}}
                    <div class="col-md-4">
                        <div class="card border mb-4">
                            <div class="card-header bg-light">
                                <h6 class="m-0 fw-bold text-primary">🔍 SEO Information</h6>
                            </div>
                            <div class="card-body">

                                {{-- Meta Title --}}
                                <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" 
                                           class="form-control @error('meta_title') is-invalid @enderror"
                                           value="{{ old('meta_title', $blog->meta_title ?? '') }}">
                                    @error('meta_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                {{-- Meta Description --}}
                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" rows="4"
                                              class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                                    @error('meta_description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                {{-- Meta Keywords --}}
                                <div class="mb-3">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" 
                                           class="form-control @error('meta_keywords') is-invalid @enderror"
                                           value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}">
                                    @error('meta_keywords') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                {{-- Submit Button --}}
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ isset($blog) ? 'Update Post' : 'Create Post' }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> {{-- row end --}}
            </form>
        </div>
    </div>
</div>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Summernote --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

<script>
$(document).ready(function(){
    $('.aiz-text-editor').summernote({
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>
@endsection
