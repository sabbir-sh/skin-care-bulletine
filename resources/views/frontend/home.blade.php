@extends('frontend.layouts.app')

@section('content')

    <!-- Slider + Recent Blogs Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">

                {{-- Left side: Featured blog carousel --}}
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm overflow-hidden">

                        @if(count($blogs) > 0)
                            <div id="featuredBlogCarousel" class="carousel slide" data-bs-ride="carousel"
                                data-bs-interval="4000">
                                <div class="carousel-inner">
                                    @foreach($blogs as $index => $blog)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <a href="{{ route('blog.show', $blog->slug) }}" class="d-block position-relative">

                                                <img src="{{ asset($blog->featured_image ?? 'path/to/default/image.jpg') }}"
                                                    class="d-block w-100 object-fit-cover" alt="{{ $blog->title }}"
                                                    style="height: 450px; border-radius: 10px;">

                                                <div class="position-absolute bottom-0 start-0 w-100 p-4 pb-3 text-white"
                                                    style="background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0));">

                                                    <small
                                                        class="text-uppercase fw-bold text-warning">{{ $blog->category->name ?? 'Uncategorized' }}</small>
                                                    <h3 class="fw-bold mb-1 mt-1">{{ Str::limit($blog->title, 70) }}</h3>
                                                    <small class="text-white-50">
                                                        <i class="bi bi-clock"></i> {{ $blog->created_at->format('M d, Y') }}
                                                    </small>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#featuredBlogCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#featuredBlogCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <div class="p-5 text-center text-muted" style="height: 450px;">No featured blogs found.</div>
                        @endif
                    </div>
                </div>

                {{-- Right side: Recent blogs (4 latest) --}}
                <div class="col-lg-4">
                    <div class="row g-3">
                        @forelse($blogs->take(4) as $blog)
                            <div class="col-6 col-md-12">
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center p-3 border rounded shadow-sm text-decoration-none">

                                    <img src="{{ asset($blog->featured_image ?? 'path/to/default/small.jpg') }}"
                                        alt="{{ $blog->title }}" class="flex-shrink-0 me-3 rounded object-fit-cover"
                                        style="width: 60px; height: 60px;">

                                    <div>
                                        <h6 class="mb-1 text-dark fw-bold">{{ Str::limit($blog->title, 40) }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar"></i> {{ $blog->created_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted">No recent posts available.</div>
                        @endforelse
                    </div>
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