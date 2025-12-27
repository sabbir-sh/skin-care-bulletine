@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <div class="row g-4">

        {{-- ================= Main Content ================= --}}
        <div class="col-lg-8">

            {{-- Blog Title --}}
            <h2 class="mb-3 fw-bold">{{ $blog->title }}</h2>

            {{-- Featured Image --}}
            <img src="{{ $blog->featured_image_url }}"
                 class="img-fluid mb-4 rounded shadow-sm"
                 alt="{{ $blog->title }}">

            {{-- Blog Content --}}
            <div class="blog-content mb-5"
                 style="text-align: justify; text-justify: inter-word;">
                {!! $blog->content !!}
            </div>

            {{-- ================= Author Box ================= --}}
            @if($blog->author)
                <div class="author-box d-flex gap-3 p-4 border rounded shadow-sm bg-light mb-5">

                    {{-- Avatar --}}
                    <img src="{{ $blog->author->avatar_url ?? asset('images/default-avatar.png') }}"
                         alt="{{ $blog->author->name }}"
                         class="rounded-circle border"
                         style="width:80px;height:80px;object-fit:cover;">

                    {{-- Info --}}
                    <div>
                        <h5 class="mb-1 fw-bold">{{ $blog->author->name }}</h5>

                        <p class="text-muted mb-2">
                            {{ $blog->author->bio ?? 'This author has not added a bio yet.' }}
                        </p>

                        {{-- Social links --}}
                        <div class="d-flex gap-2">
                            @if($blog->author->facebook)
                                <a href="{{ $blog->author->facebook }}" target="_blank">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            @endif
                            @if($blog->author->twitter)
                                <a href="{{ $blog->author->twitter }}" target="_blank">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                            @endif
                            @if($blog->author->linkedin)
                                <a href="{{ $blog->author->linkedin }}" target="_blank">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- ================= Similar Posts ================= --}}
            <div class="mt-5">
                <h4 class="mb-3 fw-bold">Similar Posts</h4>

                <div class="row g-3">
                    @forelse($similarBlogs as $similar)
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="{{ route('blog.show', $similar->slug) }}"
                               class="text-decoration-none">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ $similar->featured_image_url }}"
                                         class="card-img-top"
                                         style="height:160px;object-fit:cover;">
                                    <div class="card-body">
                                        <h6 class="card-title text-dark fw-bold">
                                            {{ Str::limit($similar->title, 45) }}
                                        </h6>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar"></i>
                                            {{ $similar->created_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted">
                            No similar posts available.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ================= Sidebar ================= --}}
        <div class="col-lg-4">

            {{-- Search --}}
            <div class="mb-4">
                <form action="{{ route('blog.search') }}" method="GET"
                      class="d-flex border rounded shadow-sm p-2">
                    <input type="text"
                           name="query"
                           class="form-control me-2"
                           placeholder="Search posts..."
                           required>
                    <button class="btn btn-secondary">Search</button>
                </form>
            </div>

            {{-- Recent Posts --}}
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Recent Posts</h5>

                <div class="list-group shadow-sm">
                    @forelse($recentBlogs as $recent)
                        <a href="{{ route('blog.show', $recent->slug) }}"
                           class="list-group-item list-group-item-action d-flex gap-3">
                            <img src="{{ $recent->featured_image_url }}"
                                 class="rounded"
                                 style="width:60px;height:60px;object-fit:cover;">
                            <div>
                                <h6 class="mb-1 fw-bold">
                                    {{ Str::limit($recent->title, 40) }}
                                </h6>
                                <small class="text-muted">
                                    {{ $recent->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </a>
                    @empty
                        <div class="list-group-item text-center text-muted">
                            No recent posts
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Categories --}}
            <div class="mb-4">
                <h5 class="mb-3 fw-bold">Categories</h5>

                <div class="list-group shadow-sm">
                    @foreach($categories as $category)
                        <a href="{{ url('category/' . $category->slug) }}"
                           class="list-group-item list-group-item-action">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
