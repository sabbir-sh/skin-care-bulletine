@extends('backend.layouts.app')

@section('title', 'Authors')

@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-1">Authors List</h2>
                <p class="text-muted mb-0">Manage blog authors & profiles</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="{{ route('author.create') }}" class="btn btn-success px-4 rounded-pill shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add Author
                </a>
            </div>
        </div>

        {{-- Author Grid --}}
        <div class="row g-3">

            @forelse($authors as $author)

                {{-- 6 per row on large screens --}}
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">

                    <div class="card h-100 border-0 shadow-sm text-center">

                        <div class="card-body p-3">

                            {{-- Avatar --}}
                            <img src="{{ $author->avatar_url }}" class="rounded-circle border mb-2" width="60" height="60"
                                style="object-fit:cover">

                            {{-- Name --}}
                            <h6 class="fw-semibold mb-0 text-truncate">
                                {{ $author->name }}
                            </h6>

                            {{-- Email --}}
                            <small class="text-muted d-block mb-2 text-truncate">
                                {{ $author->email }}
                            </small>

                            {{-- Actions --}}
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('author.edit', $author->id) }}" class="btn btn-outline-primary btn-sm px-2">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('author.destroy', $author->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this author?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm px-2">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12">
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                        No authors found
                    </div>
                </div>
            @endforelse

        </div>

@endsection