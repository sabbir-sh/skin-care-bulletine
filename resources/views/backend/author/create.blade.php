@extends('backend.layouts.app')

@section('title', isset($author) ? 'Edit Author' : 'Create Author')

@section('content')
<div class="container-fluid py-4">

    <h3 class="mb-4">
        {{ isset($author) ? 'Edit Author' : 'Create Author' }}
    </h3>

    <form action="{{ isset($author) ? route('author.update', $author->id) : route('author.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="card shadow-sm p-4">

        @csrf
        @if(isset($author))
            @method('PATCH')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $author->name ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $author->email ?? '') }}" required>
            </div>

            <div class="col-12">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="4">{{ old('bio', $author->bio ?? '') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Avatar</label>
                <input type="file" name="avatar" class="form-control">
                @if(isset($author) && $author->avatar)
                    <img src="{{ $author->avatar_url }}" class="mt-2 rounded" width="80">
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">Facebook</label>
                <input type="url" name="facebook" class="form-control"
                       value="{{ old('facebook', $author->facebook ?? '') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Twitter</label>
                <input type="url" name="twitter" class="form-control"
                       value="{{ old('twitter', $author->twitter ?? '') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">LinkedIn</label>
                <input type="url" name="linkedin" class="form-control"
                       value="{{ old('linkedin', $author->linkedin ?? '') }}">
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">
                {{ isset($author) ? 'Update Author' : 'Create Author' }}
            </button>
            <a href="{{ route('author.list') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
