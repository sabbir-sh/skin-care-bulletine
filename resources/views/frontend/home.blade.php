@extends('frontend.layouts.app')

@section('content')

    <!-- Slider + Recent Blogs Section -->


<section class="blog-section py-5" style="background-color:#f9fafb;">
    <div class="container">
        <div class="row g-4">

            {{-- Left: Featured (Dominant) Post --}}
            <div class="col-lg-8">
                @if($dominantBlog)
                    <div class="card border-0 shadow-lg overflow-hidden h-100 rounded-4 position-relative"
                         style="transition:all 0.4s ease;">
                        <a href="{{ route('blog.show', $dominantBlog->slug) }}" class="text-decoration-none text-white">
                            <div class="position-relative">
                                <img src="{{ asset($dominantBlog->featured_image ?? 'path/to/default/image.jpg') }}"
                                     class="w-100 object-fit-cover"
                                     alt="{{ $dominantBlog->title }}"
                                     style="height:480px; object-position:center; transition:transform 0.6s ease;">
                                <div class="position-absolute top-0 start-0 w-100 h-100"
                                     style="background:linear-gradient(to top,rgba(0,0,0,0.7),transparent);"></div>

                                <div class="position-absolute bottom-0 start-0 p-4 w-100">
                                    <span class="badge rounded-pill mb-2 px-3 py-2"
                                          style="background:linear-gradient(135deg,#ff9966,#ff5e62); font-size:0.75rem; letter-spacing:0.5px;">
                                        {{ $dominantBlog->category->name ?? 'Category' }}
                                    </span>
                                    <h3 class="fw-bold mb-2" style="font-size:1.9rem; line-height:1.3; text-shadow:0 3px 6px rgba(0,0,0,0.4);">
                                        {{ Str::limit($dominantBlog->title, 80) }}
                                    </h3>
                                    <div class="d-flex align-items-center small text-white-50 gap-3">
                                        <span><i class="bi bi-calendar"></i> {{ $dominantBlog->created_at->format('M d, Y') }}</span>
                                        <span><i class="bi bi-clock"></i> 5 min read</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="d-flex align-items-center justify-content-center text-center border border-2 border-secondary-subtle rounded-4 h-100 py-5 bg-white">
                        <div>
                            <i class="bi bi-file-earmark-text display-4 text-secondary"></i>
                            <h5 class="mt-3 text-muted">No Featured Blog</h5>
                            <p class="text-secondary small">Publish your first featured article!</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right: Stacked Posts --}}
            <div class="col-lg-4 d-flex flex-column" style="gap:1rem;">
                @forelse($stacked_blogs as $blog)
                    <div class="card border-0 shadow-sm overflow-hidden rounded-4 flex-fill position-relative"
                         style="height:calc(50% - 0.5rem); transition:transform 0.4s ease;">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-white h-100 d-block">
                            <div class="position-relative h-100">
                                <img src="{{ asset($blog->featured_image ?? 'path/to/default/image.jpg') }}"
                                     alt="{{ $blog->title }}"
                                     class="w-100 h-100 object-fit-cover"
                                     style="object-position:center; transition:transform 0.6s ease;">
                                <div class="position-absolute top-0 start-0 w-100 h-100"
                                     style="background:linear-gradient(to top,rgba(0,0,0,0.7),transparent);"></div>

                                <div class="position-absolute bottom-0 start-0 p-3 w-100">
                                    <span class="badge rounded-pill mb-2 px-3 py-2"
                                          style="background:linear-gradient(135deg,#56ccf2,#2f80ed); font-size:0.7rem;">
                                        {{ $blog->category->name ?? 'Topic' }}
                                    </span>
                                    <h5 class="fw-bold mb-0" style="line-height:1.4; text-shadow:0 2px 5px rgba(0,0,0,0.4);">
                                        {{ Str::limit($blog->title, 55) }}
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="d-flex align-items-center justify-content-center flex-fill border border-2 border-secondary-subtle rounded-4 bg-white text-center py-4">
                        <div>
                            <i class="bi bi-collection display-5 text-secondary"></i>
                            <h6 class="mt-2 text-muted">No Blogs Yet</h6>
                            <small class="text-secondary">More posts coming soon...</small>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</section>

{{-- Hover Animations --}}
<style>
    .blog-section .card:hover img {
        transform: scale(1.05);
    }
    .blog-section .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2) !important;
    }
</style>


    {{-- Categories --}}
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3 class="mb-5">Categories</h3>

            {{-- Desktop / Tablet view (5 per row, no slider) --}}
            <div class="row justify-content-center g-4 d-none d-md-flex">
                @foreach($categories as $category)
                    <div class="col-6 col-sm-4 col-md-2 text-center">
                        <a href="{{ url('category/' . $category->slug) }}" class="text-decoration-none text-dark">
                            <img src="{{ $category->icon ? asset('storage/' . $category->icon) : asset('images/no-image.png') }}"
                                alt="{{ $category->name }}" class="img-fluid mb-2 rounded">
                            <h5 class="mb-0">{{ $category->name }}</h5>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Mobile carousel (2 per slide) --}}
            <div id="mobileCategoryCarousel" class="carousel slide d-md-none" data-bs-ride="carousel"
                data-bs-interval="4000">
                <div class="carousel-inner">
                    @foreach($categories->chunk(2) as $index => $categoryChunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row justify-content-center g-4">
                                @foreach($categoryChunk as $category)
                                    <div class="col-6 text-center">
                                        <a href="{{ url('category/' . $category->slug) }}" class="text-decoration-none text-dark">
                                            <img src="{{ $category->icon ? asset('storage/' . $category->icon) : asset('images/no-image.png') }}"
                                                alt="{{ $category->name }}" class="img-fluid mb-2 rounded">
                                            <h5 class="mb-0">{{ $category->name }}</h5>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#mobileCategoryCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mobileCategoryCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- All Blogs Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-4">All Blogs</h2>
            <div class="row g-4">
                @forelse($blogs as $blog)
                    <div class="col-6 col-lg-4"> {{-- 2 per row on mobile, 3 per row on desktop --}}
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
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    class="btn btn-primary mt-auto align-self-start">
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