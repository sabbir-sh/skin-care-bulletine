@extends('frontend.layouts.app')

@section('content')

    <!-- Slider + Recent Blogs Section -->


<section class="blog-section" style="background-color: #f8f9fa; padding: 5rem 0;">
    <div class="container">
        {{-- Section Title (Optional but Recommended) --}}
      
        
        <div class="row g-4">

            {{-- Left side: Large Dominant Featured Post (8 Columns) --}}
            <div class="col-lg-8">
                @if($dominantBlog)
                    <div class="blog-card dominant-card overflow-hidden"
                        style="border-radius: 16px; box-shadow: 0 15px 35px rgba(0,0,0,0.15); transition: transform 0.4s ease; height: 100%; background: white;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.25)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.15)'">
                        
                        <a href="{{ route('blog.show', $dominantBlog->slug) }}" class="d-block position-relative h-100 text-decoration-none">

                            {{-- Image --}}
                            <img src="{{ asset($dominantBlog->featured_image ?? 'path/to/default/image.jpg') }}"
                                class="d-block w-100 object-fit-cover" alt="{{ $dominantBlog->title }}"
                                style="height: {{ $base_height }}; max-height: 100%; object-position: center; transition: all 0.6s ease-in-out;"
                                onmouseover="this.style.transform='scale(1.05)'; this.style.filter='brightness(1)'"
                                onmouseout="this.style.transform='scale(1)'; this.style.filter='brightness(0.9)'">

                            {{-- Text Overlay --}}
                            <div class="image-overlay"
                                style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 2.5rem 2rem 1.5rem; background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.5), transparent); color: white; transition: all 0.3s ease;">

                                <span class="category-tag"
                                    style="display: inline-block; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 0.8rem; text-transform: uppercase; box-shadow: 0 4px 15px rgba(0,0,0,0.3); line-height: 1; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                                    {{ $dominantBlog->category->name ?? 'Category' }}
                                </span>
                                <h3 class="blog-title" style="font-weight: 900; line-height: 1.3; margin-bottom: 0.75rem; text-shadow: 0 2px 5px rgba(0,0,0,0.4); font-size: 2rem;">
                                    {{ Str::limit($dominantBlog->title, 100) }}
                                </h3>
                                <div class="blog-meta text-white-50" style="font-size: 0.85rem; opacity: 0.8; display: flex; align-items: center; gap: 1rem;">
                                    <i class="bi bi-calendar"></i>
                                    <span>{{ $dominantBlog->created_at->format('M d, Y') }}</span>
                                    <i class="bi bi-clock"></i>
                                    <span>5 min read</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @else
                    {{-- Empty State for Dominant Post --}}
                    <div class="empty-state d-flex flex-column align-items-center justify-content-center text-center"
                        style="height: {{ $base_height }}; border: 3px dashed #a0aec0; background: rgba(255, 255, 255, 0.7); color: #4a5568; border-radius: 16px;">
                        <i class="bi bi-file-earmark-text display-4"></i>
                        <h5 class="mt-3">No Featured Blog</h5>
                        <p>Start publishing amazing content!</p>
                    </div>
                @endif
            </div>

            {{-- Right side: Two Stacked Featured Posts (4 Columns) --}}
            <div class="col-lg-4 d-flex flex-column stacked-container" style="height: {{ $base_height }}; gap: 1rem;">
                
                @forelse($stacked_blogs as $blog) 
                    
                    @php $card_height = 'calc(50% - 0.5rem)'; @endphp 

                    <div class="blog-card stacked-card overflow-hidden flex-fill"
                        style="height: {{ $card_height }}; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); transition: transform 0.4s ease; background: white;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.2)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)'">
                        
                        <a href="{{ route('blog.show', $blog->slug) }}" class="d-block position-relative h-100 text-decoration-none">
                            
                            {{-- Image --}}
                            <img src="{{ asset($blog->featured_image ?? 'path/to/default/small.jpg') }}"
                                class="d-block w-100 h-100 object-fit-cover" alt="{{ $blog->title }}"
                                style="object-position: center; transition: all 0.6s ease-in-out;"
                                onmouseover="this.style.transform='scale(1.05)'; this.style.filter='brightness(1)'"
                                onmouseout="this.style.transform='scale(1)'; this.style.filter='brightness(0.9)'">

                            {{-- Text Overlay --}}
                            <div class="image-overlay p-3 text-white"
                                style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 1.5rem 1rem; background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.5), transparent); color: white; transition: all 0.3s ease;">

                                <span class="category-tag text-uppercase fw-bold d-block mb-1"
                                    style="display: inline-block; padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; box-shadow: 0 2px 8px rgba(0,0,0,0.2); background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
                                    {{ $blog->category->name ?? 'Topic' }}
                                </span>
                                <h5 class="blog-title m-0" style="font-weight: 700; line-height: 1.4; font-size: 1.25rem; text-shadow: 0 1px 3px rgba(0,0,0,0.5);">
                                    {{ Str::limit($blog->title, 50) }}
                                </h5>
                            </div>
                        </a>
                    </div>
                @empty
                    {{-- Empty State for Stacked Posts --}}
                    <div class="empty-state flex-fill d-flex flex-column align-items-center justify-content-center text-center"
                        style="border: 3px dashed #a0aec0; background: rgba(255, 255, 255, 0.7); color: #4a5568; border-radius: 16px;">
                        <i class="bi bi-collection display-4"></i>
                        <h5 class="mt-3">More Content Coming</h5>
                        <p>Preparing more exciting articles.</p>
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