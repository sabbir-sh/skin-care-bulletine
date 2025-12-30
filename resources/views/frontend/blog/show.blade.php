@extends('frontend.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

<div class="container my-5" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="row g-4 g-lg-5">

        {{-- ================= Main Content ================= --}}
        <div class="col-lg-8">
            
            {{-- Header Info --}}
            <div class="mb-3 d-flex flex-wrap align-items-center gap-2 gap-sm-3">
                <span style="background: #fee2e2; color: #dc3545; padding: 5px 14px; border-radius: 50px; font-weight: 700; font-size: 11px; text-transform: uppercase;">
                    {{ $blog->category->name ?? 'Fighters' }}
                </span>
                <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> {{ $blog->created_at->format('M d, Y') }}</span>
            </div>

            {{-- Blog Title --}}
            <h1 class="mb-4 fw-bold text-dark" style="font-size: clamp(1.6rem, 5vw, 2.6rem); line-height: 1.2; letter-spacing: -0.5px;">
                {{ $blog->title }}
            </h1>

            {{-- Featured Image --}}
            <div class="mb-5 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                <img src="{{ $blog->featured_image_url }}" 
                     class="w-100" 
                     style="height: auto; max-height: 500px; object-fit: cover;"
                     alt="{{ $blog->title }}">
            </div>

            {{-- Blog Content - Justified --}}
            <div class="blog-content mb-5" style="
                font-size: 1.1rem; 
                line-height: 1.8; 
                color: #334155; 
                text-align: justify; 
                text-justify: inter-word;
                word-wrap: break-word;">
                {!! $blog->content !!}
            </div>

            <hr class="my-5" style="opacity: 0.1;">

            {{-- ================= Author Box (Always Left Aligned) ================= --}}
            @if($blog->author)
                <div class="p-3 p-md-4 mb-5 border-0 shadow-sm d-flex flex-row align-items-start gap-3 gap-md-4" 
                     style="background: #ffffff; border-radius: 20px;">
                    
                    {{-- Avatar --}}
                    <div style="flex-shrink: 0;">
                        <img src="{{ $blog->author->avatar_url ?? asset('images/default-avatar.png') }}"
                             alt="{{ $blog->author->name }}"
                             class="rounded-circle border border-2 border-light shadow-sm"
                             style="width:60px; height:60px; md-width:90px; md-height:90px; object-fit:cover;">
                    </div>

                    {{-- Info --}}
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-2 gap-2">
                            <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.1rem;">{{ $blog->author->name }}</h5>
                            
                            {{-- Social Links --}}
                            <div class="d-flex gap-2">
                                @foreach(['facebook', 'twitter', 'linkedin'] as $platform)
                                    @if($blog->author->$platform)
                                        <a href="{{ $blog->author->$platform }}" 
                                           style="width: 28px; height: 28px; background: #f1f5f9; border-radius: 6px; color: #475569; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 13px;">
                                            <i class="bi bi-{{ $platform == 'twitter' ? 'twitter-x' : $platform }}"></i>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        
                        <p class="text-muted mb-0" style="font-size: 0.85rem; line-height: 1.5; text-align: left;">
                            {{ $blog->author->bio ?? 'Dedicated contributor at Fighters. Passionate about sharing valuable information.' }}
                        </p>
                    </div>
                </div>
            @endif

            {{-- ================= Similar Posts ================= --}}
            <div class="mt-5 pt-2">
                <h4 class="fw-bold mb-4">Recommended</h4>
                <div class="row g-3">
                    @forelse($similarBlogs as $similar)
                        <div class="col-6 col-md-4">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px;">
                                <a href="{{ route('blog.show', $similar->slug) }}" class="text-decoration-none">
                                    <img src="{{ $similar->featured_image_url }}"
                                         class="card-img-top"
                                         style="height:120px; object-fit:cover; border-radius: 16px 16px 0 0;">
                                    <div class="card-body p-2 p-md-3">
                                        <h6 class="text-dark fw-bold mb-1" style="font-size: 0.85rem; line-height: 1.3;">{{ Str::limit($similar->title, 35) }}</h6>
                                        <small class="text-muted" style="font-size: 10px;">{{ $similar->created_at->format('M d') }}</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small ps-3">No similar posts found.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ================= Sidebar ================= --}}
        <div class="col-lg-4">
            <div style="position: sticky; top: 20px;">
                
                {{-- Search --}}
                <div class="p-4 mb-4 bg-white shadow-sm" style="border-radius: 20px;">
                    <form action="{{ route('blog.search') }}" method="GET" class="position-relative">
                        <input type="text" name="query" class="form-control border-0 bg-light p-3" placeholder="Search..." style="border-radius: 12px; font-size: 14px;" required>
                        <button class="btn btn-dark position-absolute top-50 end-0 translate-middle-y me-2 rounded-3" style="padding: 4px 10px;">
                            <i class="bi bi-search" style="font-size: 12px;"></i>
                        </button>
                    </form>
                </div>

                {{-- Trending --}}
                <div class="p-4 mb-4 bg-white shadow-sm" style="border-radius: 20px;">
                    <h6 class="fw-bold mb-3">Trending Now</h6>
                    @foreach($recentBlogs as $recent)
                        <a href="{{ route('blog.show', $recent->slug) }}" class="text-decoration-none d-flex gap-3 mb-3">
                            <img src="{{ $recent->featured_image_url }}" class="rounded-3 flex-shrink-0" style="width:60px; height:60px; object-fit:cover;">
                            <div>
                                <h6 class="mb-1 text-dark fw-bold" style="font-size: 0.85rem; line-height: 1.3;">{{ Str::limit($recent->title, 40) }}</h6>
                                <small class="text-muted" style="font-size: 10px;">{{ $recent->created_at->diffForHumans() }}</small>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Categories --}}
                <div class="p-4 mb-4 bg-white shadow-sm" style="border-radius: 20px;">
                    <h6 class="fw-bold mb-3">Categories</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($categories as $category)
                            <a href="{{ url('category/' . $category->slug) }}" 
                               class="btn btn-light btn-sm border-0 px-3 py-2 text-dark"
                               style="background: #f1f5f9; border-radius: 8px; font-size: 11px; font-weight: 600;">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection