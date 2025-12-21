@extends('backend.layouts.app')

@section('title', 'Authors')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Author List</h3>
        <a href="{{ route('author.create') }}" class="btn btn-primary">
            + Add Author
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $key => $author)
                        <tr>
                            <td>{{ $authors->firstItem() + $key }}</td>
                            <td>
                                <img src="{{ $author->avatar_url }}" width="50" class="rounded-circle">
                            </td>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->email }}</td>
                            <td>
                                <a href="{{ route('author.edit', $author->id) }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>

                                <form action="{{ route('author.destroy', $author->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this author?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No authors found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $authors->links() }}
        </div>
    </div>
</div>
@endsection
