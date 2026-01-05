@extends('backend.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-cog me-2 text-primary"></i> Website Settings</h5>
        </div>

        <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
            @csrf
            @method('PATCH')

            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- Site Name --}}
                    <div class="col-md-4">
                        <label class="form-label fw-600">Site Name</label>
                        <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $setting->site_name ?? '') }}" style="border-radius: 8px;">
                    </div>

                    {{-- Logo --}}
                    <div class="col-md-4">
                        <label class="form-label fw-600">Logo</label>
                        <input type="file" name="logo" class="form-control" style="border-radius: 8px;">
                        @if($setting?->logo)
                            <div class="mt-2 position-relative d-inline-block border p-1 rounded bg-light">
                                <img src="{{ asset('storage/' . $setting->logo) }}" height="45">
                                <button type="button" onclick="removeImage('logo', this)" class="btn btn-danger btn-sm position-absolute shadow-sm" style="top:-10px; right:-10px; border-radius: 50%; padding: 2px 7px;">&times;</button>
                            </div>
                        @endif
                    </div>

                    {{-- Favicon --}}
                    <div class="col-md-4">
                        <label class="form-label fw-600">Favicon</label>
                        <input type="file" name="favicon" class="form-control" style="border-radius: 8px;">
                        @if($setting?->favicon)
                            <div class="mt-2 position-relative d-inline-block border p-1 rounded bg-light">
                                <img src="{{ asset('storage/' . $setting->favicon) }}" height="30">
                                <button type="button" onclick="removeImage('favicon', this)" class="btn btn-danger btn-sm position-absolute shadow-sm" style="top:-10px; right:-10px; border-radius: 50%; padding: 2px 7px;">&times;</button>
                            </div>
                        @endif
                    </div>

                    <div class="col-12"><hr class="opacity-10"></div>

                    {{-- Meta Info --}}
                    <div class="col-md-6">
                        <label class="form-label fw-600">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ $setting->meta_title ?? '' }}" style="border-radius: 8px;">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-600">Homepage Layout</label>
                        <select name="homepage_layout" class="form-select" style="border-radius: 8px;">
                            <option value="default" {{ ($setting->homepage_layout ?? '') == 'default' ? 'selected' : '' }}>Default Layout</option>
                            <option value="blog" {{ ($setting->homepage_layout ?? '') == 'blog' ? 'selected' : '' }}>Blog Layout</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-600">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3" style="border-radius: 8px;">{{ $setting->meta_description ?? '' }}</textarea>
                    </div>

                    <div class="col-12"><hr class="opacity-10"></div>

                    {{-- Social Links --}}
                    <div class="col-md-4">
                        <label class="form-label fw-600"><i class="fab fa-facebook text-primary me-1"></i> Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="{{ $setting->social_links['facebook'] ?? '' }}" style="border-radius: 8px;" placeholder="https://facebook.com/...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-600"><i class="fab fa-twitter text-info me-1"></i> Twitter</label>
                        <input type="text" name="twitter" class="form-control" value="{{ $setting->social_links['twitter'] ?? '' }}" style="border-radius: 8px;" placeholder="https://twitter.com/...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-600"><i class="fab fa-youtube text-danger me-1"></i> YouTube</label>
                        <input type="text" name="youtube" class="form-control" value="{{ $setting->social_links['youtube'] ?? '' }}" style="border-radius: 8px;" placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light p-3 text-end" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius: 8px;">Update Settings</button>
            </div>
        </form>
    </div>
</div>

<script>
    function removeImage(type, btn) {
        if(confirm('Are you sure you want to remove this image?')) {
            const form = document.getElementById('settingsForm');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = type + '_remove';
            input.value = '1';
            form.appendChild(input);
            btn.parentElement.remove();
        }
    }
</script>

<style>
    .fw-600 { font-weight: 600; font-size: 0.9rem; color: #444; }
    .form-control:focus, .form-select:focus { border-color: #3b71ca; box-shadow: 0 0 0 0.2rem rgba(59, 113, 202, 0.1); }
</style>
@endsection