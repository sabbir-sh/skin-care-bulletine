@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h3>{{ $setting ? 'Edit Settings' : 'Create Settings' }}</h3>

    <form action="{{ route('setting.update') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- Site Name --}}
        <div class="mb-3">
            <label>Site Name</label>
            <input type="text"
                   name="site_name"
                   class="form-control"
                   value="{{ old('site_name', $setting->site_name ?? '') }}">
        </div>

        {{-- Logo --}}
        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">

            @if($setting?->logo)
                <img src="{{ $setting->logo_url }}" height="50" class="mt-2">
            @endif
        </div>

        {{-- Favicon --}}
        <div class="mb-3">
            <label>Favicon</label>
            <input type="file" name="favicon" class="form-control">
        </div>

        {{-- Meta Title --}}
        <div class="mb-3">
            <label>Meta Title</label>
            <input type="text"
                   name="meta_title"
                   class="form-control"
                   value="{{ old('meta_title', $setting->meta_title ?? '') }}">
        </div>

        {{-- Meta Description --}}
        <div class="mb-3">
            <label>Meta Description</label>
            <textarea name="meta_description"
                      class="form-control"
                      rows="3">{{ old('meta_description', $setting->meta_description ?? '') }}</textarea>
        </div>

        {{-- Social Links --}}
        <div class="mb-3">
            <label>Facebook</label>
            <input type="text"
                   name="facebook"
                   class="form-control"
                   value="{{ old('facebook', $setting->social_links['facebook'] ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Twitter</label>
            <input type="text"
                   name="twitter"
                   class="form-control"
                   value="{{ old('twitter', $setting->social_links['twitter'] ?? '') }}">
        </div>

        <div class="mb-3">
            <label>YouTube</label>
            <input type="text"
                   name="youtube"
                   class="form-control"
                   value="{{ old('youtube', $setting->social_links['youtube'] ?? '') }}">
        </div>

        {{-- Homepage Layout --}}
        <div class="mb-3">
            <label>Homepage Layout</label>
            <select name="homepage_layout" class="form-control">
                <option value="default"
                    {{ ($setting->homepage_layout ?? '') == 'default' ? 'selected' : '' }}>
                    Default
                </option>
                <option value="blog"
                    {{ ($setting->homepage_layout ?? '') == 'blog' ? 'selected' : '' }}>
                    Blog
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Save Settings
        </button>

        <a href="{{ route('setting.list') }}" class="btn btn-secondary">
            Back
        </a>
    </form>
</div>
@endsection
