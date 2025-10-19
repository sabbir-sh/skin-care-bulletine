@extends('frontend.layouts.app')

@section('content')
    <!-- Hero Banner -->
    <section
        style="position: relative; width: 100%; height: 400px; background: url('{{ asset('uploads/blog/1.jpg') }}') center/cover no-repeat;">
        <!-- Overlay -->
        <div style="position: absolute; top:0; left:0; right:0; bottom:0; background-color: rgba(0,0,0,0.5);"></div>

        <!-- Content -->
        <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center position-relative"
            style="z-index: 1;">
            <h1 class="text-white fw-bold mb-3">Our Latest Blogs</h1>
            <p class="text-white lead">Stay updated with our tips, news, and insights on skincare</p>
        </div>
    </section>

    <!-- Latest Blogs Section -->
 <section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-6 col-lg-4"> <!-- Mobile: 2 per row, Desktop: 3 per row -->
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