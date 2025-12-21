@extends('backend.layouts.app')

@section('title', 'Contact Messages')

@section('content')

<div class="container-fluid py-4">
    <h3 class="mb-4">Contact Messages</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Received</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $key => $message)
                        <tr>
                            <td>{{ $messages->firstItem() + $key }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ Str::limit($message->message, 50) }}</td>
                            <td>{{ $message->created_at ? $message->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                            <td class="text-center">
                                <a href="{{ route('contact.show', $message->id) }}"
                                   class="btn btn-sm btn-primary me-1 mb-1">
                                    View
                                </a>

                                <form action="{{ route('contact.destroy', $message->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mb-1">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No messages found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
