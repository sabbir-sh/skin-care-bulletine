@extends('frontend.layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row g-4">

            {{-- Main Content (Left) --}}
            <div class="col-lg-8">
                {{-- Blog Title --}}
                <h2 class="mb-3">{{ $blog->title }}</h2>

                {{-- Featured Image --}}
                @if($blog->featured_image)
                    <img src="{{ asset($blog->featured_image) }}" class="img-fluid mb-3 rounded" alt="{{ $blog->title }}">
                @endif

                {{-- Blog Content --}}
                <div class="text-justify" style="text-align: justify; text-justify: inter-word;">
                    {!! $blog->content !!}
                </div>

                {{-- Similar Posts --}}
                <div class="mt-5">
                    <h4 class="mb-3">Similar Posts</h4>
                    <div class="row g-3">
                        @forelse($similarBlogs as $similar)
                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="{{ route('blog.show', $similar->slug) }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center p-3 border rounded shadow-sm text-decoration-none">
                                    <img src="{{ asset($similar->featured_image ?? 'path/to/default/small.jpg') }}"
                                        alt="{{ $similar->title }}" class="flex-shrink-0 me-3 rounded object-fit-cover"
                                        style="width: 60px; height: 60px;">
                                    <div>
                                        <h6 class="mb-1 text-dark fw-bold">{{ Str::limit($similar->title, 40) }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar"></i> {{ $similar->created_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted">No similar posts available.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Sidebar (Right) --}}
            <div class="col-lg-4">
                {{-- Search Form --}}
                <br>
                <br>
                <br>
                <div class="mb-4 border rounded shadow-sm p-2 d-flex align-items-center">
                    <form action="{{ route('blog.search') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="query" class="form-control me-2" placeholder="Search posts..."
                            style="height: 60px;" required>
                        <button type="submit" class="btn btn-secondary" style="height: 60px;">Search</button>
                    </form>
                </div>


                {{-- Recent Posts --}}
                <div class="mb-4">
                    <h5 class="mb-3">Recent Posts</h5>
                    <div class="list-group list-group-flush border rounded shadow-sm">
                        @forelse($recentBlogs as $recent)
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
                            <a href="{{ url('category/' . $category->slug) }}" class="list-group-item list-group-item-action">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection