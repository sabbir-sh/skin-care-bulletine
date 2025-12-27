@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="m-0">{{ isset($blog) ? 'Edit Blog Post' : 'Create Blog Post' }}</h5>
        </div>

        <div class="card-body">
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

                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ old('title', $blog->title ?? '') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="slug" id="slug"
                                           class="form-control @error('slug') is-invalid @enderror"
                                           value="{{ old('slug', $blog->slug ?? '') }}">
                                </div>

                                {{-- Professional CKEditor Field --}}
                                <div class="mb-3">
                                    <label class="form-label">Content <span class="text-danger">*</span></label>
                                    <div id="editor-container">
                                        <textarea name="content" id="blog_content" class="form-control">{{ old('content', $blog->content ?? '') }}</textarea>
                                    </div>
                                    <style>
                                        /* এডিটরের উচ্চতা ফিক্স করার জন্য */
                                        .ck-editor__editable_inline {
                                            min-height: 400px;
                                        }
                                    </style>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Featured Image</label>
                                    <input type="file" name="featured_image" class="form-control">
                                    @if(isset($blog) && $blog->featured_image)
                                        <img src="{{ asset($blog->featured_image) }}" width="120" class="mt-2 rounded shadow border">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="0" {{ (old('status', $blog->status ?? 0) == 0) ? 'selected' : '' }}>Draft</option>
                                        <option value="1" {{ (old('status', $blog->status ?? 1) == 1) ? 'selected' : '' }}>Published</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- RIGHT SECTION --}}
                    <div class="col-md-4">
                        <div class="card border mb-4">
                            <div class="card-header bg-light">
                                <h6 class="m-0 fw-bold text-primary">🔍 SEO & Author</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blog->meta_title ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" rows="4" class="form-control">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Author</label>
                                    <select name="author_id" class="form-select" required>
                                        <option value="">-- Select Author --</option>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}" {{ old('author_id', $blog->author_id ?? '') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-success btn-lg">{{ isset($blog) ? 'Update Post' : 'Create Post' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#blog_content'), {
            toolbar: [
                'heading', '|', 
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                'insertTable', 'undo', 'redo', 'imageUpload', 'mediaEmbed'
            ],
        })
        .catch(error => {
            console.error(error);
        });

    // Auto Slug Generator (Optional)
    $('#title').keyup(function() {
        let text = $(this).val().toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
        $('#slug').val(text);
    });
</script>

@endsection