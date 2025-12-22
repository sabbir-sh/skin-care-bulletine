@extends('backend.layouts.app')

@section('title', isset($author) ? 'Edit Author' : 'Create Author')

@section('content')
<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            {{ isset($author) ? 'Edit Author' : 'Create Author' }}
        </h2>
        <p class="text-muted mb-0">Author profile information</p>
    </div>

    <form action="{{ isset($author) ? route('author.update', $author->id) : route('author.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @if(isset($author))
            @method('PATCH')
        @endif

        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body">

                <div class="row g-4">

                    {{-- Name --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $author->name ?? '') }}"
                               required>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $author->email ?? '') }}"
                               required>
                    </div>

                    {{-- Avatar --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Avatar</label>
                        <input type="file" name="avatar" class="form-control">

                        @if(isset($author) && $author->avatar)
                            <div class="mt-2">
                                <img src="{{ $author->avatar_url }}"
                                     class="rounded-circle border shadow-sm"
                                     width="70" height="70"
                                     style="object-fit:cover">
                            </div>
                        @endif
                    </div>

                    {{-- Bio --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Bio</label>
                        <textarea name="bio"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Short author biography...">{{ old('bio', $author->bio ?? '') }}</textarea>
                    </div>

                    {{-- Facebook --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Facebook</label>
                        <input type="url"
                               name="facebook"
                               class="form-control"
                               placeholder="https://facebook.com/username"
                               value="{{ old('facebook', $author->facebook ?? '') }}">
                    </div>

                    {{-- Twitter --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Twitter</label>
                        <input type="url"
                               name="twitter"
                               class="form-control"
                               placeholder="https://twitter.com/username"
                               value="{{ old('twitter', $author->twitter ?? '') }}">
                    </div>

                    {{-- LinkedIn --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">LinkedIn</label>
                        <input type="url"
                               name="linkedin"
                               class="form-control"
                               placeholder="https://linkedin.com/in/username"
                               value="{{ old('linkedin', $author->linkedin ?? '') }}">
                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
                <a href="{{ route('author.list') }}" class="btn btn-light px-4">
                    Cancel
                </a>

                <button type="submit" class="btn btn-success px-4">
                    {{ isset($author) ? 'Update Author' : 'Create Author' }}
                </button>
            </div>
        </div>

    </form>
</div>
@endsection
