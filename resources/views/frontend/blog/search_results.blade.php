@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <h3>Search results for "{{ $query }}"</h3>
    <div class="row g-4 mt-3">
        @forelse($blogs as $blog)
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none">
                    <div class="border rounded shadow-sm p-3">
                        @if($blog->featured_image)
                            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid mb-2 rounded">
                        @endif
                        <h6 class="fw-bold text-dark">{{ Str::limit($blog->title, 50) }}</h6>
                        <small class="text-muted">{{ $blog->created_at->format('M d, Y') }}</small>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No posts found.</div>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $blogs->links() }}
    </div>
</div>
@endsection
