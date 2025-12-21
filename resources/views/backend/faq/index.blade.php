@extends('backend.layouts.app')

@section('title', 'FAQ List')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>FAQ List</h3>
        <a href="{{ route('faq.create') }}" class="btn btn-primary">+ Add FAQ</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $key => $faq)
                        <tr>
                            <td>{{ $faqs->firstItem() + $key }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>{{ Str::limit($faq->answer, 50) }}</td>
                            <td>
                                @if($faq->image)
                                    <img src="{{ $faq->image_url }}" alt="FAQ Image" width="80">
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $faq->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $faq->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Delete this FAQ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No FAQs found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $faqs->links() }}
        </div>
    </div>
</div>
@endsection
