@extends('backend.layouts.app')

@section('content')
<div class="container-fluid py-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-light text-black">
            <h3 class="mb-0">
                {{ $setting ? 'Edit Website Settings' : 'Create Website Settings' }}
            </h3>
        </div>

        <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="card-body">
                <div class="row g-4">

                    {{-- Site Name --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-bold">Site Name</label>
                            <input type="text" name="site_name" class="form-control"
                                value="{{ old('site_name', $setting->site_name ?? '') }}">
                        </div>
                    </div>

                    {{-- Logo --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-bold">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if($setting?->logo)
                                <img src="{{ $setting->logo_url }}" height="45" class="mt-2">
                            @endif
                        </div>
                    </div>

                    {{-- Favicon --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-bold">Favicon</label>
                            <input type="file" name="favicon" class="form-control">
                            @if($setting?->favicon)
                                <img src="{{ $setting->favicon_url }}" height="30" class="mt-2">
                            @endif
                        </div>
                    </div>

                    {{-- Meta Title --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-bold">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control"
                                value="{{ old('meta_title', $setting->meta_title ?? '') }}">
                        </div>
                    </div>

                    {{-- Meta Description --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-bold">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $setting->meta_description ?? '') }}</textarea>
                        </div>
                    </div>

                    {{-- Homepage Layout --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-bold">Homepage Layout</label>
                            <select name="homepage_layout" class="form-select">
                                <option value="default" {{ ($setting->homepage_layout ?? '') == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="blog" {{ ($setting->homepage_layout ?? '') == 'blog' ? 'selected' : '' }}>Blog</option>
                            </select>
                        </div>
                    </div>

                    {{-- Facebook --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-bold">Facebook</label>
                            <input type="text" name="facebook" class="form-control"
                                value="{{ old('facebook', $setting->social_links['facebook'] ?? '') }}">
                        </div>
                    </div>

                    {{-- Twitter --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-bold">Twitter</label>
                            <input type="text" name="twitter" class="form-control"
                                value="{{ old('twitter', $setting->social_links['twitter'] ?? '') }}">
                        </div>
                    </div>

                    {{-- YouTube --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-bold">YouTube</label>
                            <input type="text" name="youtube" class="form-control"
                                value="{{ old('youtube', $setting->social_links['youtube'] ?? '') }}">
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer Buttons --}}
            <div class="card-footer bg-light text-end">
                <button type="submit" class="btn btn-success px-4">
                    Save Settings
                </button>
                <a href="{{ route('setting.list') }}" class="btn btn-secondary px-4">
                    Back
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
