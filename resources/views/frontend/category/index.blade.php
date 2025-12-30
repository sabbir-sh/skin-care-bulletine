@extends('frontend.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

{{-- Header Section --}}
<section style="background: linear-gradient(135deg, #e63946, #c1121f); padding: 60px 0; color: #fff; margin-bottom: 40px; border-radius: 0 0 50px 50px; text-align: center; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="container">
        <h1 style="font-size: clamp(1.8rem, 5vw, 3rem); font-weight: 800; margin-bottom: 10px;">
            {{ $category->name }}
        </h1>
        <p style="opacity: 0.9; font-size: 16px;">Exploring stories and insights</p>
    </div>
</section>

<div class="container pb-5" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="row g-4">
        
        {{-- Main Content (Left Side) --}}
        <div class="col-lg-9 order-2 order-lg-1">
            
            {{-- Search & Info Bar --}}
            <div class="d-flex align-items-center justify-content-between mb-4 bg-white p-3 shadow-sm" style="border-radius: 15px;">
                <h6 class="mb-0 fw-bold text-dark">
                    Showing: <span class="text-danger">{{ $blogs->total() }} Articles</span>
                </h6>
                <a href="{{ route('home') }}" class="text-decoration-none text-muted small fw-bold">
                    <i class="bi bi-house-door me-1"></i> Home / {{ $category->name }}
                </a>
            </div>

            @if($blogs->count() > 0)
                <div class="row g-4">
                    @foreach($blogs as $blog)
                        <div class="col-md-6 col-xl-4">
                            <div class="card border-0 h-100 blog-card" 
                                 style="background: #fff; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow: hidden; transition: 0.3s;">
                                
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none">
                                    {{-- Image --}}
                                    <div style="position: relative; height: 180px; overflow: hidden;">
                                        <img src="{{ $blog->featured_image_url }}" 
                                             alt="{{ $blog->title }}"
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                        <div style="position: absolute; top: 10px; right: 10px; background: rgba(230, 57, 70, 0.9); color: #fff; padding: 4px 10px; border-radius: 8px; font-size: 10px; font-weight: 700;">
                                            {{ $blog->created_at->format('M d') }}
                                        </div>
                                    </div>

                                    {{-- Body --}}
                                    <div class="card-body p-3">
                                        <h6 style="color: #0f172a; font-weight: 700; line-height: 1.4; margin-bottom: 8px; height: 2.8rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                            {{ $blog->title }}
                                        </h6>
                                        <p class="text-muted" style="font-size: 12px; line-height: 1.5; height: 2.3rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                            {{ Str::limit(strip_tags($blog->content), 80) }}
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between pt-2 border-top mt-2">
                                            <span class="text-danger fw-bold" style="font-size: 11px;">Read More <i class="bi bi-arrow-right"></i></span>
                                            <span class="text-muted" style="font-size: 10px;"><i class="bi bi-person me-1"></i> {{ $blog->author->name ?? 'Admin' }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5 bg-white shadow-sm" style="border-radius: 20px;">
                    <i class="bi bi-folder-x display-4 text-muted"></i>
                    <h5 class="mt-3 fw-bold">No articles found in this category.</h5>
                </div>
            @endif
        </div>

        {{-- Sidebar (Right Side) --}}
        <div class="col-lg-3 order-1 order-lg-2">
            <div style="position: sticky; top: 20px;">
                
                {{-- Category List Card --}}
                <div class="bg-white p-4 shadow-sm mb-4" style="border-radius: 20px; border: 1px solid #f1f5f9;">
                    <h5 class="fw-800 mb-4 text-dark" style="border-left: 4px solid #e63946; padding-left: 15px;">Categories</h5>
                    
                    <div class="d-flex flex-column gap-2">
                        @foreach($allCategories as $cat)
                            <a href="{{ url('category/' . $cat->slug) }}" 
                               class="d-flex align-items-center justify-content-between p-2 px-3 text-decoration-none transition-all"
                               style="border-radius: 10px; font-size: 14px; font-weight: 600; 
                                      background: {{ $category->id == $cat->id ? '#fee2e2' : 'transparent' }}; 
                                      color: {{ $category->id == $cat->id ? '#dc3545' : '#475569' }};">
                                <span><i class="bi bi-hash me-1"></i> {{ $cat->name }}</span>
                                @if($category->id == $cat->id)
                                    <i class="bi bi-check-circle-fill"></i>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .transition-all { transition: 0.3s; }
    .transition-all:hover { background: #f8fafc !important; color: #dc3545 !important; transform: translateX(5px); }
    .blog-card:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important; }
    
    /* Pagination Color Fix */
    .pagination .page-item.active .page-link { background-color: #dc3545; border-color: #dc3545; }
    .pagination .page-link { color: #dc3545; border-radius: 8px; margin: 0 3px; }

    @media (max-width: 991px) {
        section { padding: 40px 0; border-radius: 0 0 30px 30px; }
    }
</style>
@endsection