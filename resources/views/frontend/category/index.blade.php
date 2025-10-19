@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">{{ $category->name }}</h2>

    @if($blogs->count() > 0)
        <div class="row g-4">
            @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm">
                            @if($blog->featured_image)
                                <img src="{{ asset($blog->featured_image) }}" class="card-img-top" style="height:200px; object-fit:cover;" alt="{{ $blog->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text text-muted">{{ $blog->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">No posts found in this category.</p>
    @endif
</div>
@endsection
