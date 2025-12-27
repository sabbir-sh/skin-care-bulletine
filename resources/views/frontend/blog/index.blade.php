@extends('frontend.layouts.app')

@section('title', 'Our Blogs')

@section('content')

{{-- Blog Hero Section --}}
<section class="about-hero">
    <style>
        .about-hero {
            background: linear-gradient(135deg, #f8f9fa, #eef1f5);
            padding: 80px 0;
            text-align: center;
        }
        .about-title {
            font-size: 2.8rem;
            font-weight: 800;
        }
        .about-subtitle {
            color: #6c757d;
            max-width: 800px;
            margin: 20px auto 0;
        }

        .about-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 12px 35px rgba(0,0,0,.08);
            height: 100%;
        }

        @media (max-width: 575px) {
            .about-title {
                font-size: 2rem;
            }
        }
    </style>

    <div class="container">
        <h1 class="about-title">Our Blogs</h1>
        <p class="about-subtitle lead">
            Stay updated with our tips, news, and insights across multiple topics.
        </p>
    </div>
</section>

{{-- Latest Blogs Section --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        @if($blog->featured_image)
                            <a href="{{ route('blog.show', $blog->slug) }}">
                                <img src="{{ asset($blog->featured_image) }}" class="card-img-top" alt="{{ $blog->title }}"
                                     style="height:200px; object-fit:cover;">
                            </a>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title fw-semibold">{{ $blog->title }}</h5>
                            </a>
                            <p class="card-text text-truncate" style="max-height:60px;">
                                {!! Str::limit(strip_tags($blog->content), 120) !!}
                            </p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-primary mt-auto align-self-start">
                                Read More <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="card-footer bg-white border-0 pt-0">
                            <small class="text-muted">Published: {{ $blog->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No blogs found.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
