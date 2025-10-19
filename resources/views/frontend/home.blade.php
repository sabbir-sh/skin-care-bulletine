@extends('frontend.layouts.app')

@section('content')

    <!-- Slider + Recent Blogs Section -->
    <section class="py-5 bg-light">
        <div class="container"> <!-- Same width container -->
            <div class="row g-4">

                <!-- Left: Slider -->
                <div class="col-lg-8">
                    <div id="blogCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            @foreach($blogs as $index => $blog)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    @if($blog->featured_image)
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="d-block position-relative">
                                            <img src="{{ asset($blog->featured_image) }}" class="d-block w-100"
                                                alt="{{ $blog->title }}" style="height:400px; object-fit:cover;">
                                            <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                                style="background: rgba(0,0,0,0.5);">
                                                <h4 class="text-white m-0">{{ $blog->title }}</h4>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#blogCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#blogCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Right: Recent Blogs List (2 per row) -->
                <div class="col-lg-4">
                    <div class="row g-3">
                        @foreach($blogs->take(4) as $blog)
                            <div class="col-6">
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    class="d-block text-decoration-none text-dark border p-2 rounded">
                                    @if($blog->featured_image)
                                        <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}"
                                            class="img-fluid mb-2"
                                            style="height:80px; object-fit:cover; width:100%; border-radius:5px;">
                                    @endif
                                    <h6 class="mb-1">{{ $blog->title }}</h6>
                                    <small class="text-muted">{{ $blog->created_at->format('M d, Y') }}</small>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

{{-- Categories --}}
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3 class="mb-5">Categories</h3>

            {{-- Desktop / Tablet view --}}
            <div class="row justify-content-center g-4 d-none d-md-flex">
                @foreach($categories as $category)
                    <div class="col-6 col-sm-4 col-md-3 text-center">
                        <a href="{{ url('category/' . $category->slug) }}" class="text-decoration-none text-dark">
                            <img src="{{ $category->icon ? asset('storage/' . $category->icon) : asset('images/no-image.png') }}"
                                alt="{{ $category->name }}" class="img-fluid mb-2"
                                style="height:300px; width:300px; object-fit:cover;">
                            <h5 class="mb-0">{{ $category->name }}</h5>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Mobile view slider --}}
            <div id="categoryCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($categories->chunk(2) as $index => $categoryChunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row justify-content-center g-4">
                                @foreach($categoryChunk as $category)
                                    <div class="col-6 text-center">
                                        <a href="{{ url('category/' . $category->slug) }}" class="text-decoration-none text-dark">
                                            <img src="{{ $category->icon ? asset('storage/' . $category->icon) : asset('images/no-image.png') }}"
                                                alt="{{ $category->name }}" class="img-fluid mb-2"
                                                style="height:300px; width:300px; object-fit:cover;">
                                            <h5 class="mb-0">{{ $category->name }}</h5>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </section>





    <!-- All Blogs Section -->
    <section class="py-5 bg-light">
        <div class="container"> <!-- Same container width -->
            <h2 class="mb-4">All Blogs</h2>
            <div class="row g-4">
                @forelse($blogs as $blog)
                    <div class="col-md-6 col-lg-4">
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