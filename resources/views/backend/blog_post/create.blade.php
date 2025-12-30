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
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 35px; background: white; padding: 25px; border-radius: 16px; border: 1px solid #eef2f1; shadow: 0 4px 6px rgba(0,0,0,0.02);">
                        <div>
                            <h3 style="font-weight: 800; color: #1a202c; margin-bottom: 5px; letter-spacing: -0.5px;">
                                {{ isset($blog) ? 'Update Article' : 'Create New Article' }}
                            </h3>
                            <p style="color: #718096; font-size: 14px; margin-bottom: 0;">Fill in the details to publish
                                your content to the world.</p>
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <a href="{{ route('blog.list') }}" class="btn btn-light"
                                style="border-radius: 10px; padding: 10px 25px; font-weight: 600; border: 1px solid #e2e8f0; color: #4a5568;">Cancel</a>
                            <button type="submit" class="btn btn-success"
                                style="border-radius: 10px; padding: 10px 25px; font-weight: 600; background-color: #2f855a; border: none; box-shadow: 0 4px 12px rgba(47, 133, 90, 0.2);">
                                <i class="fas fa-paper-plane me-2"></i> {{ isset($blog) ? 'Update Post' : 'Publish Now' }}
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        {{-- LEFT SECTION: Content Box --}}
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
                                            style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; transition: 0.3s; font-size: 16px; font-weight: 500;"
                                            onfocus="this.style.borderColor='#48bb78'"
                                            onblur="this.style.borderColor='#edf2f7'"
                                            placeholder="e.g. 10 Best Travel Destinations"
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
                                                style="flex: 1; border: none; background: transparent; padding: 10px 15px; outline: none; font-size: 14px; color: #4a5568;"
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

                        {{-- RIGHT SECTION: Sidebar Boxes --}}
                        <div class="col-lg-4">
                            {{-- Meta & Publishing Box --}}
                            <div
                                style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 25px;">
                                <div
                                    style="padding: 20px; border-bottom: 1px solid #f7fafc; display: flex; align-items: center; gap: 10px;">
                                    <i class="fas fa-cog" style="color: #718096;"></i>
                                    <h6 style="margin: 0; font-weight: 700; color: #2d3748;">Publishing Settings</h6>
                                </div>
                                <div style="padding: 20px;">
                                    <div style="margin-bottom: 20px;">
                                        <label
                                            style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Category</label>
                                        <select name="category_id"
                                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #edf2f7; font-size: 14px; outline: none;"
                                            required>
                                            <option value="">-- Choose Category --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
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

                                    <div>
                                        <label
                                            style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Visibility
                                            Status</label>
                                        <div
                                            style="display: flex; gap: 20px; padding: 10px; background: #f8fafc; border-radius: 8px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="draft"
                                                    value="0" {{ (old('status', $blog->status ?? 0) == 0) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="draft"
                                                    style="font-size: 14px; color: #718096;">Draft</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="publish"
                                                    value="1" {{ (old('status', $blog->status ?? 1) == 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="publish"
                                                    style="font-size: 14px; color: #2f855a; font-weight: 700;">Public</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Featured Image Box --}}
                            <div
                                style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 25px;">
                                <div style="padding: 20px; border-bottom: 1px solid #f7fafc;">
                                    <h6 style="margin: 0; font-weight: 700; color: #2d3748;">Featured Image</h6>
                                </div>
                                <div style="padding: 20px; text-align: center;">
                                    <div
                                        style="background: #f8fafc; border: 2px dashed #e2e8f0; border-radius: 12px; padding: 15px; margin-bottom: 15px;">

                                        @php
                                            $imagePath = asset('images/placeholder-img.jpg');
                                            if (isset($blog) && $blog->image) {
                                                $imagePath = asset('storage/' . $blog->image);
                                            }
                                        @endphp

                                        <img id="imagePreview" src="{{ $imagePath }}"
                                            style="max-width: 100%; border-radius: 8px; max-height: 180px; width: 100%; object-fit: cover; display: block;"
                                            onerror="this.src='{{ asset('images/placeholder-img.jpg') }}';">
                                    </div>

                                    <input type="file" name="featured_image" id="featured_image" onchange="previewFile()"
                                        style="font-size: 13px; color: #718096; width: 100%;">
                                    <small style="display: block; margin-top: 10px; color: #a0aec0; font-size: 11px;">
                                        Supported: JPG, PNG, WEBP
                                    </small>
                                </div>
                            </div>

                            {{-- SEO Box --}}
                            <div
                                style="background: #1a202c; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden;">
                                <div
                                    style="padding: 15px 20px; background: rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.1);">
                                    <h6
                                        style="margin: 0; font-weight: 700; color: #cbd5e0; font-size: 12px; text-uppercase; letter-spacing: 1px;">
                                        SEO Optimization</h6>
                                </div>
                                <div style="padding: 20px;">
                                    <div style="margin-bottom: 15px;">
                                        <label
                                            style="display: block; font-weight: 600; color: #a0aec0; margin-bottom: 8px; font-size: 13px;">Meta
                                            Title</label>
                                        <input type="text" name="meta_title"
                                            style="width: 100%; background: #2d3748; border: 1px solid #4a5568; border-radius: 8px; padding: 8px 12px; color: white; font-size: 14px; outline: none;"
                                            value="{{ old('meta_title', $blog->meta_title ?? '') }}">
                                    </div>
                                    <div>
                                        <label
                                            style="display: block; font-weight: 600; color: #a0aec0; margin-bottom: 8px; font-size: 13px;">Meta
                                            Description</label>
                                        <textarea name="meta_description" rows="3"
                                            style="width: 100%; background: #2d3748; border: 1px solid #4a5568; border-radius: 8px; padding: 8px 12px; color: white; font-size: 14px; outline: none; resize: none;">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        // CKEditor Styling Injection (since CKEditor is dynamic)
        ClassicEditor.create(document.querySelector('#blog_content')).then(editor => {
            editor.editing.view.change(writer => {
                writer.setStyle('min-height', '400px', editor.editing.view.document.getRoot());
            });
        }).catch(error => console.error(error));

        // Slug Generator
        $('#title').on('input', function () {
            let slug = $(this).val().toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
            $('#slug').val(slug);
        });

        // Preview Image
        function previewFile() {
            const preview = document.querySelector('#imagePreview');
            const file = document.querySelector('#featured_image').files[0];
            const reader = new FileReader();
            reader.onloadend = () => preview.src = reader.result;
            if (file) reader.readAsDataURL(file);
        }
    </script>
@endsection