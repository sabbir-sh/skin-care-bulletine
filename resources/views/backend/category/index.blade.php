@extends('backend.layouts.app')

@section('content')
<div class="container-fluid" style="padding: 30px 45px; background-color: #f4f7f6; min-height: 100vh;">
    
    {{-- Page Header --}}
    <div style="margin-bottom: 30px; background: white; padding: 25px; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
        <h3 style="font-weight: 800; color: #1a202c; margin-bottom: 5px; letter-spacing: -0.5px;">Category Management</h3>
        <p style="color: #718096; font-size: 14px; margin-bottom: 0;">Organize your products or posts by managing categories effectively.</p>
    </div>

    <div class="row g-4">
        {{-- LEFT SIDE: Category Form --}}
        <div class="col-lg-4">
            <div style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden; position: sticky; top: 30px;">
                <div style="padding: 20px 25px; border-bottom: 1px solid #f7fafc; background: #fafcfe;">
                    <h6 style="margin: 0; font-weight: 700; color: #2d3748;">
                        {{ isset($category) ? 'Edit Category' : 'Create New Category' }}
                    </h6>
                </div>
                
                <div style="padding: 25px;">
                    <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($category)) @method('PATCH') @endif

                        {{-- Name --}}
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Category Name <span style="color: #e53e3e;">*</span></label>
                            <input type="text" name="name" id="cat_name"
                                   style="width: 100%; padding: 10px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; transition: 0.3s;"
                                   onfocus="this.style.borderColor='#48bb78'" onblur="this.style.borderColor='#edf2f7'"
                                   value="{{ old('name', $category->name ?? '') }}" required placeholder="e.g. Electronics">
                            @error('name') <small style="color: #e53e3e; font-size: 12px;">{{ $message }}</small> @enderror
                        </div>

                        {{-- Slug --}}
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Slug (URL)</label>
                            <input type="text" name="slug" id="cat_slug"
                                   style="width: 100%; padding: 10px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; background: #f8fafc; color: #718096;"
                                   value="{{ old('slug', $category->slug ?? '') }}" placeholder="electronics-gadgets">
                        </div>

                        {{-- Status --}}
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Visibility Status</label>
                            <select name="status" style="width: 100%; padding: 10px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; background: white;">
                                <option value="1" {{ (old('status', $category->status ?? 1) == 1) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ (old('status', $category->status ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        {{-- Banner & Icon (Two columns) --}}
                        <div class="row g-3">
                            <div class="col-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Banner</label>
                                <div style="border: 2px dashed #edf2f7; border-radius: 12px; padding: 10px; text-align: center; margin-bottom: 10px;">
                                    <img id="bannerPreview" 
                                         src="{{ isset($category) && $category->banner ? asset('storage/'.$category->banner) : asset('images/no-image.png') }}" 
                                         style="width: 100%; height: 60px; object-fit: cover; border-radius: 6px;">
                                </div>
                                <input type="file" name="banner" onchange="previewImage(event, 'bannerPreview')" style="font-size: 11px; width: 100%;">
                            </div>
                            <div class="col-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Icon</label>
                                <div style="border: 2px dashed #edf2f7; border-radius: 12px; padding: 10px; text-align: center; margin-bottom: 10px;">
                                    <img id="iconPreview" 
                                         src="{{ isset($category) && $category->icon ? asset('storage/'.$category->icon) : asset('images/no-image.png') }}" 
                                         style="height: 60px; width: 60px; object-fit: contain; border-radius: 6px;">
                                </div>
                                <input type="file" name="icon" onchange="previewImage(event, 'iconPreview')" style="font-size: 11px; width: 100%;">
                            </div>
                        </div>

                        <div style="margin-top: 30px;">
                            <button type="submit" class="btn btn-success w-100" 
                                    style="border-radius: 12px; padding: 12px; font-weight: 700; background: #2f855a; border: none; box-shadow: 0 4px 12px rgba(47, 133, 90, 0.2);">
                                <i class="fas fa-check-circle me-2"></i> {{ isset($category) ? 'Update Category' : 'Save Category' }}
                            </button>
                            @if(isset($category))
                                <a href="{{ route('category.index') }}" class="btn btn-light w-100 mt-2" style="border-radius: 12px; padding: 10px; font-weight: 600; color: #718096; border: 1px solid #e2e8f0;">Cancel Edit</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE: Category List Table --}}
        <div class="col-lg-8">
            <div style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden;">
                <div style="padding: 20px 25px; border-bottom: 1px solid #f7fafc; background: #fafcfe; display: flex; justify-content: space-between; align-items: center;">
                    <h6 style="margin: 0; font-weight: 700; color: #2d3748;">All Categories</h6>
                    <span style="background: #ebf8ff; color: #3182ce; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Total: {{ $categories->count() }}</span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0 10px;">
                        <thead style="background: #f8fafc;">
                            <tr>
                                <th style="padding: 15px 25px; border: none; font-size: 12px; text-transform: uppercase; color: #718096; letter-spacing: 0.5px;">Name</th>
                                <th style="padding: 15px; border: none; font-size: 12px; text-transform: uppercase; color: #718096;">Visuals</th>
                                <th style="padding: 15px; border: none; font-size: 12px; text-transform: uppercase; color: #718096;">Status</th>
                                <th style="padding: 15px 25px; border: none; font-size: 12px; text-transform: uppercase; color: #718096; text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="background: white;">
                            @forelse($categories as $item)
                                <tr style="transition: 0.2s;">
                                    <td style="padding: 15px 25px;">
                                        <div style="font-weight: 700; color: #2d3748; font-size: 15px;">{{ $item->name }}</div>
                                        <div style="font-size: 12px; color: #a0aec0;">slug: /{{ $item->slug }}</div>
                                    </td>
                                    <td style="padding: 15px;">
                                        <div style="display: flex; gap: 10px; align-items: center;">
                                            <div title="Banner" style="width: 50px; height: 30px; border-radius: 4px; overflow: hidden; border: 1px solid #edf2f7;">
                                                <img src="{{ $item->banner ? asset('storage/'.$item->banner) : asset('images/no-image.png') }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                            <div title="Icon" style="width: 30px; height: 30px; border-radius: 4px; overflow: hidden; background: #f8fafc; padding: 4px;">
                                                <img src="{{ $item->icon ? asset('storage/'.$item->icon) : asset('images/no-image.png') }}" style="width: 100%; height: 100%; object-fit: contain;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 15px;">
                                        @if($item->status)
                                            <span style="padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #f0fff4; color: #2f855a; border: 1px solid #c6f6d5;">Active</span>
                                        @else
                                            <span style="padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #fff5f5; color: #c53030; border: 1px solid #fed7d7;">Inactive</span>
                                        @endif
                                    </td>
                                    <td style="padding: 15px 25px; text-align: right;">
                                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                            <a href="{{ route('category.edit', $item->id) }}" 
                                               style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background: #ebf8ff; color: #3182ce; transition: 0.3s; text-decoration: none;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('category.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background: #fff5f5; color: #e53e3e; border: none; transition: 0.3s;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding: 40px; text-align: center; color: #a0aec0; font-style: italic;">No categories available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Automatic Slug Generation
    $('#cat_name').on('input', function() {
        let slug = $(this).val().toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
        $('#cat_slug').val(slug);
    });

    // Image Preview Function
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById(previewId);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection