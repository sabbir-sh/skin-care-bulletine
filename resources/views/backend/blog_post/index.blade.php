@extends('backend.layouts.app')

@section('content')
<div class="card" style="border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
    <div class="card-header d-flex justify-content-between align-items-center" style="background:#f8f9fa; border-bottom:1px solid #e9ecef;">
        <h5 style="margin:0; font-weight:600; color:#343a40;">All Blog Posts</h5>
        <a href="{{ route('blog.create') }}" class="btn btn-primary btn-sm" style="font-weight:600;">
            <i class="bi bi-plus"></i> Add New
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success rounded">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:5%;">#</th>
                        <th style="width:10%;">Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th style="width:15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $key => $blog)
                        <tr>
                            <td>{{ $blogs->firstItem() + $key }}</td>
                            <td>
                                @if($blog->featured_image)
                                    <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="rounded" style="width:60px; height:60px; object-fit:cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($blog->title, 50) }}</td>
                            <td>{{ $blog->category->name ?? 'N/A' }}</td>
                            <td>
                                @if($blog->status)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>{{ $blog->created_at->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-info me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No blog posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $blogs->links() }}
        </div>
    </div>
</div>
@endsection
