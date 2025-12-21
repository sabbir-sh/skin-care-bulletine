@extends('backend.layouts.app')

@section('title', 'View Message')

@section('content')

<div class="container py-4">

    <a href="{{ route('contact.list') }}" class="btn btn-light mb-3">
        ← Back
    </a>

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-3">Message Details</h4>

            <p><strong>Name:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Received:</strong> {{ $contact->created_at ? $contact->created_at->format('d M Y, h:i A') : 'N/A' }}</p>

            <hr>

            <p>{{ $contact->message }}</p>

        </div>
    </div>
</div>

@endsection
