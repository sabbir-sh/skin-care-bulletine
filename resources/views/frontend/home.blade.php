@extends('frontend.layouts.app')

@section('content')

    <!-- Slider + Recent Blogs Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            {{-- Setting the base height for the layout on large screens --}}
            @php $base_height = '400px'; @endphp

            {{-- Left side: Large Dominant Featured Post (8 Columns) --}}
            <div class="col-lg-8">
                @php $dominantBlog = $blogs->get(0); @endphp

                @if($dominantBlog)
                    <div class="card border-0 shadow-lg h-100 overflow-hidden rounded-3">
                        <a href="{{ route('blog.show', $dominantBlog->slug) }}" class="d-block position-relative h-100">

                            {{-- Image: Takes up most of the space --}}
                            <img src="{{ asset($dominantBlog->featured_image ?? 'path/to/default/image.jpg') }}"
                                 class="d-block w-100 object-fit-cover" alt="{{ $dominantBlog->title }}"
                                 style="height: {{ $base_height }}; max-height: 100%; object-position: center;">

                            {{-- Text Overlay --}}
                            <div class="position-absolute bottom-0 start-0 w-100 p-4 pb-3 text-white"
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.85), rgba(0,0,0,0));">

                                <small class="text-uppercase fw-bold text-warning d-block mb-1">
                                    {{ $dominantBlog->category->name ?? 'Category' }}
                                </small>
                                <h3 class="fw-bolder mb-2">{{ Str::limit($dominantBlog->title, 100) }}</h3>
                                <small class="text-white-50">
                                    <i class="bi bi-calendar"></i> {{ $dominantBlog->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="p-5 text-center text-muted border rounded-3 d-flex align-items-center justify-content-center" style="height: {{ $base_height }};">
                        No dominant featured blog found.
                    </div>
                @endif
            </div>

            {{-- Right side: Two Stacked Featured Posts (4 Columns) --}}
            {{-- d-flex and flex-column are essential for vertical stacking/filling --}}
            <div class="col-lg-4 d-flex flex-column" style="height: {{ $base_height }}; gap: 1rem;">
                
                @php $stacked_blogs = $blogs->slice(1, 2); @endphp

                @forelse($stacked_blogs as $blog) 
                    
                    {{-- The fixed height for each stacked card is (BASE_HEIGHT - GAP) / 2 --}}
                    @php $card_height = 'calc(50% - 0.5rem)'; @endphp 

                    <div class="card border-0 shadow-lg overflow-hidden rounded-3 flex-fill mb-0" style="height: {{ $card_height }};">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="d-block position-relative h-100">
                            
                            {{-- Image --}}
                            <img src="{{ asset($blog->featured_image ?? 'path/to/default/small.jpg') }}"
                                 class="d-block w-100 h-100 object-fit-cover" alt="{{ $blog->title }}"
                                 style="object-position: center;">

                            {{-- Text Overlay --}}
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white"
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.85), rgba(0,0,0,0));">

                                <small class="text-uppercase fw-bold text-info d-block mb-1">
                                    {{ $blog->category->name ?? 'Topic' }}
                                </small>
                                <h5 class="fw-bolder m-0">{{ Str::limit($blog->title, 50) }}</h5>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="p-4 text-center text-muted border rounded-3 flex-fill d-flex align-items-center justify-content-center">
                        Not enough blogs for the stacked layout.
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</section>


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