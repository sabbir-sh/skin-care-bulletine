@extends('backend.layouts.app')

@section('content')
<div class="container my-5">
    <div class="row g-4">

        {{-- Category Form --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        {{ isset($category) ? 'Edit Category' : 'Add New Category' }}
                    </h5>
                </div>
                <div class="card-body">
                    <form 
                        action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" 
                        method="POST" 
                        enctype="multipart/form-data">

                        @csrf
                        @if(isset($category))
                            @method('PATCH')
                        @endif

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="form-control" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" class="form-control">
                            @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ (old('status', $category->status ?? 1) == 1) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ (old('status', $category->status ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        {{-- Banner --}}
                        <div class="mb-3">
                            <label class="form-label">Banner</label>
                            <input type="file" name="banner" class="form-control" accept="image/*" onchange="previewImage(event, 'bannerPreview')">
                            <div class="mt-2">
                                <img id="bannerPreview"
                                    src="{{ isset($category) && $category->banner ? asset('storage/'.$category->banner) : asset('images/no-image.png') }}"
                                    alt="Banner Preview" class="img-fluid rounded" style="max-height: 120px;">
                            </div>
                        </div>

                        {{-- Icon --}}
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="file" name="icon" class="form-control" accept="image/*" onchange="previewImage(event, 'iconPreview')">
                            <div class="mt-2">
                                <img id="iconPreview"
                                    src="{{ isset($category) && $category->icon ? asset('storage/'.$category->icon) : asset('images/no-image.png') }}"
                                    alt="Icon Preview" class="img-fluid rounded" style="max-height: 80px;">
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">
                                {{ isset($category) ? 'Update Category' : 'Save Category' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- Category List --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">All Categories</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Banner</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ $item->banner ? asset('storage/'.$item->banner) : asset('images/no-image.png') }}" alt="Banner" width="60">
                                        </td>
                                        <td>
                                            <img src="{{ $item->icon ? asset('storage/'.$item->icon) : asset('images/no-image.png') }}" alt="Icon" width="40">
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $item->status ? 'success' : 'danger' }}">
                                                {{ $item->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('category.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this category?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- JS for image preview --}}
<script>
function previewImage(event, previewId) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById(previewId).src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
