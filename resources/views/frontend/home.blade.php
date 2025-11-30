@extends('frontend.layouts.app')

@section('content')

<section class="blog-hero-section py-5" style="background-color:#f8f9fa;">
    <div class="container">
        <div class="row g-4">

            {{-- Left: Featured (Dominant) Post --}}
            <div class="col-lg-8">
                @if($dominantBlog)
                    <div class="blog-card-dominant card border-0 shadow-lg overflow-hidden h-100 rounded-4 position-relative">
                        <a href="{{ route('blog.show', $dominantBlog->slug) }}" class="text-decoration-none text-white h-100 d-block">
                            <div class="position-relative h-100">
                                <img src="{{ asset($dominantBlog->featured_image ?? 'path/to/default/image.jpg') }}"
                                     class="w-100 object-fit-cover blog-img"
                                     alt="{{ $dominantBlog->title }}"
                                     style="height:480px; object-position:center;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 blog-overlay"
                                     style="background:linear-gradient(to top,rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 50%, transparent 100%);"></div>

                                <div class="position-absolute bottom-0 start-0 p-4 p-md-5 w-100">
                                    <span class="badge rounded-pill mb-3 px-3 py-2 text-uppercase fw-bold blog-category-badge"
                                          style="background:linear-gradient(135deg,#ff6b6b,#f06595); font-size:0.75rem; letter-spacing:1px;">
                                        {{ $dominantBlog->category->name ?? 'Featured' }}
                                    </span>
                                    <h1 class="fw-bolder mb-3" style="font-size:2.2rem; line-height:1.2; text-shadow:0 5px 10px rgba(0,0,0,0.6);">
                                        {{ Str::limit($dominantBlog->title, 80) }}
                                    </h1>
                                    <div class="d-flex align-items-center small text-white-75 gap-3">
                                        <span class="opacity-75"><i class="bi bi-calendar me-1"></i> {{ $dominantBlog->created_at->format('M d, Y') }}</span>
                                        <span class="opacity-75"><i class="bi bi-clock me-1"></i> 5 min read</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="d-flex align-items-center justify-content-center text-center border border-2 border-secondary-subtle rounded-4 h-100 py-5 bg-white shadow-sm">
                        <div>
                            <i class="bi bi-file-earmark-text display-4 text-muted"></i>
                            <h5 class="mt-3 text-secondary fw-semibold">No Featured Blog</h5>
                            <p class="text-secondary small">Publish your first featured article!</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right: Stacked Posts --}}
            <div class="col-lg-4 d-flex flex-column" style="gap:1rem;">
                @forelse($stacked_blogs as $blog)
                    <div class="blog-card-stacked card border-0 shadow-sm overflow-hidden rounded-4 flex-fill position-relative">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-white h-100 d-block">
                            <div class="position-relative h-100">
                                <img src="{{ asset($blog->featured_image ?? 'path/to/default/image.jpg') }}"
                                     alt="{{ $blog->title }}"
                                     class="w-100 h-100 object-fit-cover blog-img"
                                     style="object-position:center;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 blog-overlay"
                                     style="background:linear-gradient(to top,rgba(0,0,0,0.85) 0%, transparent 100%);"></div>

                                <div class="position-absolute bottom-0 start-0 p-3 w-100">
                                    <span class="badge rounded-pill mb-2 px-3 py-2 text-uppercase fw-bold blog-category-badge"
                                          style="background:linear-gradient(135deg,#56ccf2,#2f80ed); font-size:0.65rem; letter-spacing:0.5px;">
                                        {{ $blog->category->name ?? 'Topic' }}
                                    </span>
                                    <h5 class="fw-bolder mb-0" style="line-height:1.4; text-shadow:0 2px 5px rgba(0,0,0,0.5);">
                                        {{ Str::limit($blog->title, 55) }}
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="d-flex align-items-center justify-content-center flex-fill border border-2 border-secondary-subtle rounded-4 bg-white text-center py-4 shadow-sm">
                        <div>
                            <i class="bi bi-collection display-5 text-muted"></i>
                            <h6 class="mt-2 text-secondary fw-semibold">No Recent Blogs</h6>
                            <small class="text-secondary">More posts coming soon...</small>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</section>

---

<section class="py-5 bg-white">
    <div class="container text-center">
        <h2 class="mb-5 fw-bolder text-dark">Explore Topics</h2>

        {{-- Desktop / Tablet view (5 per row, no slider) --}}
        <div class="row justify-content-center g-4 d-none d-md-flex">
            @forelse($categories as $category)
                <div class="col-6 col-sm-4 col-md-2 text-center category-item">
                    <a href="{{ url('category/' . $category->slug) }}" class="text-decoration-none text-dark d-block">
                        <div class="category-icon-box mx-auto mb-3 p-3 rounded-circle shadow-sm bg-light">
                             {{-- Placeholder Icon (Replace with actual $category->icon if it's a file path) --}}
                             @if($category->icon)
                                 <img src="{{ asset('storage/' . $category->icon) }}"
                                      alt="{{ $category->name }}" class="img-fluid category-icon">
                             @else
                                 <i class="bi bi-folder text-primary display-6"></i> {{-- Default Bootstrap Icon --}}
                             @endif
                        </div>
                        <h6 class="mb-0 fw-semibold">{{ $category->name }}</h6>
                    </a>
                </div>
            @empty
                <p class="text-muted">No categories available.</p>
            @endforelse
        </div>

        {{-- Mobile carousel (2 per slide) --}}
        <div id="mobileCategoryCarousel" class="carousel slide d-md-none" data-bs-ride="carousel"
             data-bs-interval="4000">
            <div class="carousel-inner pb-4">
                @foreach($categories->chunk(2) as $index => $categoryChunk)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row justify-content-center g-4">
                            @foreach($categoryChunk as $category)
                                <div class="col-6 text-center category-item">
                                    <a href="{{ url('category/' . $category->slug) }}" class="text-decoration-none text-dark d-block">
                                        <div class="category-icon-box mx-auto mb-3 p-3 rounded-circle shadow-sm bg-light">
                                            @if($category->icon)
                                                <img src="{{ asset('storage/' . $category->icon) }}"
                                                     alt="{{ $category->name }}" class="img-fluid category-icon">
                                            @else
                                                <i class="bi bi-folder text-primary display-6"></i>
                                            @endif
                                        </div>
                                        <h6 class="mb-0 fw-semibold">{{ $category->name }}</h6>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#mobileCategoryCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3 opacity-75" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mobileCategoryCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3 opacity-75" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

---

<section class="py-5" style="background-color:#f8f9fa;">
    <div class="container">
        <h2 class="mb-5 fw-bolder text-dark">Latest Articles</h2>
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-6 col-lg-4"> {{-- 2 per row on mobile, 3 per row on desktop --}}
                    <div class="blog-card-standard card h-100 shadow-sm border-0 overflow-hidden rounded-3">
                        @if($blog->featured_image)
                            <a href="{{ route('blog.show', $blog->slug) }}" class="d-block overflow-hidden">
                                <img src="{{ asset($blog->featured_image) }}" class="card-img-top blog-img" alt="{{ $blog->title }}"
                                     style="height:200px; object-fit:cover;">
                            </a>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title fw-bold mb-3">{{ $blog->title }}</h5>
                            </a>
                            <p class="card-text text-muted small flex-grow-1" style="max-height:60px; overflow:hidden;">
                                {!! Str::limit(strip_tags($blog->content), 100) !!}
                            </p>
                            <a href="{{ route('blog.show', $blog->slug) }}"
                               class="btn btn-dark mt-3 align-self-start read-more-btn">
                                Read More <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="card-footer bg-white border-0 pt-0">
                            <small class="text-muted"><i class="bi bi-calendar me-1"></i> {{ $blog->created_at->format('M d, Y') }}</small>
                            <span class="ms-3 small text-muted"><i class="bi bi-tag me-1"></i> {{ $blog->category->name ?? 'Uncategorized' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-x-octagon display-4 text-secondary"></i>
                    <p class="text-muted mt-3">No articles published yet.</p>
                </div>
            @endforelse
        </div>
        {{-- Add Pagination if $blogs is a paginator instance --}}
        @if(method_exists($blogs, 'links'))
            <div class="d-flex justify-content-center mt-5">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Global Card Hover Effect */
    .blog-card-dominant, .blog-card-stacked, .blog-card-standard {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .blog-card-dominant:hover, .blog-card-stacked:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important;
    }

    .blog-card-standard:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    /* Image Hover Zoom */
    .blog-card-dominant:hover .blog-img,
    .blog-card-stacked:hover .blog-img,
    .blog-card-standard:hover .blog-img {
        transform: scale(1.05);
    }
    .blog-img {
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94); /* Smooth transition */
    }

    /* Overlay adjustments */
    .blog-overlay {
        transition: opacity 0.4s ease;
    }
    .blog-card-dominant:hover .blog-overlay {
        opacity: 0.8; /* Make background slightly darker on hover */
    }

    /* Category Icons Styling */
    .category-icon-box {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .category-icon-box:hover {
        background-color: #e9ecef !important;
        border-color: var(--bs-primary);
        transform: translateY(-5px);
    }

    .category-icon {
        width: 100%; /* For actual images */
        height: 100%;
        object-fit: contain;
    }

    .category-item a:hover h6 {
        color: var(--bs-primary) !important;
    }

    /* Custom Read More Button */
    .read-more-btn {
        background-color: #343a40; /* Darker tone */
        border-color: #343a40;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .read-more-btn:hover {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        transform: translateX(3px);
    }

</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the Bootstrap Carousel for mobile categories (if not done automatically)
        var mobileCarousel = document.getElementById('mobileCategoryCarousel');
        if (mobileCarousel) {
            new bootstrap.Carousel(mobileCarousel, {
                interval: 4000
            });
        }
        
        // Optional: Smooth scroll links for a Single Page Application feel
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
@endpush