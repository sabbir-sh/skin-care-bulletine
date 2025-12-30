@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 30px 45px; background-color: #f4f7f6; min-height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <form action="{{ isset($blog) ? route('blog.update', $blog->id) : route('blog.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if(isset($blog)) @method('PATCH') @endif

                    {{-- Header Section --}}
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 35px; background: white; padding: 25px; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                        <div>
                            <h3 style="font-weight: 800; color: #1a202c; margin-bottom: 5px; letter-spacing: -0.5px;">
                                {{ isset($blog) ? 'Update Article' : 'Create New Article' }}
                            </h3>
                            <p style="color: #718096; font-size: 14px; margin-bottom: 0;">Fill in the details to publish
                                your content.</p>
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <a href="{{ route('blog.list') }}" class="btn btn-light"
                                style="border-radius: 10px; padding: 10px 25px; font-weight: 600; border: 1px solid #e2e8f0;">Cancel</a>
                            <button type="submit" class="btn btn-success"
                                style="border-radius: 10px; padding: 10px 25px; font-weight: 600; background-color: #2f855a; border: none;">
                                <i class="fas fa-paper-plane me-2"></i> {{ isset($blog) ? 'Update Post' : 'Publish Now' }}
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div
                                style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden; margin-bottom: 25px;">
                                <div style="padding: 25px; border-bottom: 1px solid #f7fafc; background: #fafcfe;">
                                    <h6 style="margin: 0; font-weight: 700; color: #2d3748;">Main Content</h6>
                                </div>
                                <div style="padding: 30px;">
                                    <div style="margin-bottom: 25px;">
                                        <label
                                            style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Post
                                            Title <span style="color: #e53e3e;">*</span></label>
                                        <input type="text" name="title" id="title"
                                            style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none;"
                                            value="{{ old('title', $blog->title ?? '') }}" required>
                                    </div>

                                    <div style="margin-bottom: 25px;">
                                        <label
                                            style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">URL
                                            Slug</label>
                                        <div
                                            style="display: flex; align-items: center; background: #f8fafc; border: 2px solid #edf2f7; border-radius: 10px; overflow: hidden;">
                                            <span
                                                style="padding: 10px 15px; background: #edf2f7; color: #718096; font-size: 14px; font-weight: 600;">/blog/</span>
                                            <input type="text" name="slug" id="slug"
                                                style="flex: 1; border: none; background: transparent; padding: 10px 15px; outline: none;"
                                                value="{{ old('slug', $blog->slug ?? '') }}">
                                        </div>
                                    </div>

                                    <div style="margin-bottom: 0;">
                                        <label
                                            style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Content
                                            Editor <span style="color: #e53e3e;">*</span></label>
                                        <textarea name="content"
                                            id="blog_content">{{ old('content', $blog->content ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            {{-- Category & Visibility --}}
                            <div
                                style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 25px; padding: 20px;">
                                <div style="margin-bottom: 20px;">
                                    <label
                                        style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Category</label>
                                    <select name="category_id"
                                        style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #edf2f7;"
                                        required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (old('category_id', $blog->category_id ?? '') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label
                                        style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Status</label>
                                    <select name="status"
                                        style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #edf2f7;">
                                        <option value="1" {{ (old('status', $blog->status ?? 1) == 1) ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="0" {{ (old('status', $blog->status ?? 1) == 0) ? 'selected' : '' }}>
                                            Draft</option>
                                    </select>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label
                                        style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Author</label>
                                    <select name="author_id"
                                        style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #edf2f7; font-size: 14px; outline: none;"
                                        required>
                                        <option value="">-- Choose Author --</option>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}" {{ old('author_id', $blog->author_id ?? '') == $author->id ? 'selected' : '' }}>
                                                {{ $author->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Featured Image Box (FIXED) --}}
                            <div
                                style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 25px;">
                                <div style="padding: 20px; border-bottom: 1px solid #f7fafc;">
                                    <h6 style="margin: 0; font-weight: 700; color: #2d3748;">Featured Image</h6>
                                </div>
                                <div style="padding: 20px; text-align: center;">
                                    <div
                                        style="background: #f8fafc; border: 2px dashed #e2e8f0; border-radius: 12px; padding: 15px; margin-bottom: 15px;">
                                        @php
                                            $currentImage = isset($blog) && $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('frontend/images/no-image.jpg');
                                        @endphp

                                        <img id="imagePreview" src="{{ $currentImage }}"
                                            style="max-width: 100%; border-radius: 8px; max-height: 180px; width: 100%; object-fit: cover; display: block;"
                                            onerror="this.src='https://via.placeholder.com/300x200?text=No+Image+Found';">
                                    </div>

                                    <input type="file" name="featured_image" id="featured_image" onchange="previewFile()"
                                        style="font-size: 13px; color: #718096; width: 100%;">
                                </div>
                            </div>

                            {{-- SEO Box --}}
                            <div style="background: #1a202c; border-radius: 16px; overflow: hidden; padding: 20px;">
                                <h6
                                    style="color: #cbd5e0; font-size: 12px; text-transform: uppercase; margin-bottom: 15px;">
                                    SEO Optimization</h6>
                                <input type="text" name="meta_title" placeholder="Meta Title"
                                    style="width: 100%; background: #2d3748; border: 1px solid #4a5568; border-radius: 8px; padding: 8px 12px; color: white; margin-bottom: 10px;"
                                    value="{{ old('meta_title', $blog->meta_title ?? '') }}">
                                <textarea name="meta_description" rows="3" placeholder="Meta Description"
                                    style="width: 100%; background: #2d3748; border: 1px solid #4a5568; border-radius: 8px; padding: 8px 12px; color: white;">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
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
        // CKEditor
        ClassicEditor.create(document.querySelector('#blog_content')).catch(error => console.error(error));

        // Improved Slug Generator (Bangla Support handles)
        $('#title').on('input', function () {
            let title = $(this).val().toLowerCase();
            let slug = title.replace(/[^a-z0-9\s-]/g, '') // remove special chars
                .replace(/\s+/g, '-')         // replace spaces with dash
                .replace(/-+/g, '-');         // remove double dashes
            $('#slug').val(slug);
        });

        // Live Image Preview
        function previewFile() {
            const preview = document.querySelector('#imagePreview');
            const file = document.querySelector('#featured_image').files[0];
            const reader = new FileReader();
            reader.onloadend = () => preview.src = reader.result;
            if (file) reader.readAsDataURL(file);
        }
    </script>
@endsection