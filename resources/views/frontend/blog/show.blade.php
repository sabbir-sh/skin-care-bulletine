@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <div class="row g-4">

        {{-- Main Content (Left) --}}
        <div class="col-lg-8">
            <h2 class="mb-3">{{ $blog->title }}</h2>

            @if($blog->featured_image)
                <img src="{{ asset($blog->featured_image) }}" class="img-fluid mb-3 rounded" alt="{{ $blog->title }}">
            @endif

            <div class="text-justify" style="text-align: justify; text-justify: inter-word;">
                {!! $blog->content !!}
            </div>
        </div>

        {{-- Sidebar (Right) --}}
        <div class="col-lg-4">
            {{-- Recent Posts --}}
            <div class="mb-4">
                <h5 class="mb-3">Recent Posts</h5>
                <div class="list-group list-group-flush border rounded shadow-sm">
                    @forelse($recentBlogs->take(5) as $recent)
                        <a href="{{ route('blog.show', $recent->slug) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center p-3">
                           
                           <img src="{{ asset($recent->featured_image ?? 'path/to/default/small.jpg') }}"
                                alt="{{ $recent->title }}" class="flex-shrink-0 me-3 rounded object-fit-cover"
                                style="width: 60px; height: 60px;">

                           <div>
                               <h6 class="mb-1 text-dark fw-bold">{{ Str::limit($recent->title, 40) }}</h6>
                               <small class="text-muted">
                                   <i class="bi bi-calendar"></i> {{ $recent->created_at->format('M d, Y') }}
                               </small>
                           </div>
                        </a>
                    @empty
                        <div class="p-3 text-center text-muted">No recent posts available.</div>
                    @endforelse
                </div>
            </div>

            {{-- Categories --}}
            <div class="mb-4">
                <h5 class="mb-3">Categories</h5>
                <div class="list-group list-group-flush border rounded shadow-sm">
                    @foreach($categories as $category)
                        <a href="{{ url('category/'.$category->slug) }}" class="list-group-item list-group-item-action">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
