@extends('backend.layouts.app')

@section('content')
<div class="container-fluid" style="padding: 35px; background-color: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
    
    {{-- Page Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;">
        <div>
            <h3 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 24px; letter-spacing: -0.5px;">Category Hub</h3>
            <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Manage and organize your product architecture.</p>
        </div>
        <div>
            <span style="background: white; padding: 10px 20px; border-radius: 12px; border: 1px solid #e2e8f0; font-weight: 600; color: #475569; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                Total Categories: <span style="color: #2563eb;">{{ $categories->count() }}</span>
            </span>
        </div>
    </div>

    <div class="row g-4">
        {{-- LEFT SIDE: Form --}}
        <div class="col-lg-4">
            <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); overflow: hidden; position: sticky; top: 20px;">
                <div style="padding: 25px; border-bottom: 1px solid #f1f5f9; background: linear-gradient(to right, #ffffff, #f8fafc);">
                    <h6 style="margin: 0; font-weight: 700; color: #334155; display: flex; align-items: center;">
                        <i class="fas fa-plus-circle me-2" style="color: #2563eb;"></i>
                        {{ isset($category) ? 'Update Category' : 'Add New Category' }}
                    </h6>
                </div>
                
                <div style="padding: 25px;">
                    <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($category)) @method('PATCH') @endif

                        <div style="margin-bottom: 18px;">
                            <label style="font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 13px; display: block;">Name</label>
                            <input type="text" name="name" id="cat_name"
                                   style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #cbd5e1; font-size: 14px; transition: all 0.2s;"
                                   onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 4px rgba(37, 99, 235, 0.1)';" 
                                   onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';"
                                   value="{{ old('name', $category->name ?? '') }}" required placeholder="e.g. জীবন বাঁচানোর গল্প">
                        </div>

                        <div style="margin-bottom: 18px;">
                            <label style="font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 13px; display: block;">Slug</label>
                            <input type="text" name="slug" id="cat_slug" readonly
                                   style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f1f5f9; color: #64748b; font-size: 14px;">
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="font-weight: 600; color: #475569; margin-bottom: 8px; font-size: 13px; display: block;">Display Status</label>
                            <div style="display: flex; gap: 10px;">
                                <select name="status" style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #cbd5e1; background: white; font-size: 14px;">
                                    <option value="1" {{ (old('status', $category->status ?? 1) == 1) ? 'selected' : '' }}>Public / Active</option>
                                    <option value="0" {{ (old('status', $category->status ?? 1) == 0) ? 'selected' : '' }}>Hidden / Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3" style="margin-bottom: 25px;">
                            <div class="col-6">
                                <p style="font-weight: 600; color: #475569; font-size: 12px; margin-bottom: 10px;">Banner Image</p>
                                <label style="cursor: pointer; width: 100%;">
                                    <div style="border: 2px dashed #e2e8f0; border-radius: 12px; padding: 10px; text-align: center; transition: 0.3s;" onmouseover="this.style.borderColor='#2563eb'" onmouseout="this.style.borderColor='#e2e8f0'">
                                        <img id="bannerPreview" src="{{ isset($category) && $category->banner ? asset('storage/'.$category->banner) : asset('images/no-image.png') }}" style="width: 100%; height: 50px; object-fit: cover; border-radius: 8px;">
                                        <input type="file" name="banner" onchange="previewImage(event, 'bannerPreview')" hidden>
                                    </div>
                                </label>
                            </div>
                            <div class="col-6">
                                <p style="font-weight: 600; color: #475569; font-size: 12px; margin-bottom: 10px;">Category Icon</p>
                                <label style="cursor: pointer; width: 100%;">
                                    <div style="border: 2px dashed #e2e8f0; border-radius: 12px; padding: 10px; text-align: center; transition: 0.3s;" onmouseover="this.style.borderColor='#2563eb'" onmouseout="this.style.borderColor='#e2e8f0'">
                                        <img id="iconPreview" src="{{ isset($category) && $category->icon ? asset('storage/'.$category->icon) : asset('images/no-image.png') }}" style="width: 35px; height: 35px; object-fit: contain;">
                                        <input type="file" name="icon" onchange="previewImage(event, 'iconPreview')" hidden>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn w-100" 
                                style="background: #2563eb; color: white; border-radius: 12px; padding: 14px; font-weight: 700; border: none; transition: 0.3s; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(37, 99, 235, 0.3)';" 
                                onmouseout="this.style.transform='translateY(0)';" >
                            {{ isset($category) ? 'Save Changes' : 'Create Category' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE: Table --}}
        <div class="col-lg-8">
            <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); overflow: hidden;">
                <table class="table mb-0" style="border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr style="background: #f8fafc;">
                            <th style="padding: 20px 25px; border-bottom: 1px solid #e2e8f0; color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase;">Details</th>
                            <th style="padding: 20px; border-bottom: 1px solid #e2e8f0; color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase;">Media</th>
                            <th style="padding: 20px; border-bottom: 1px solid #e2e8f0; color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase;">Status</th>
                            <th style="padding: 20px 25px; border-bottom: 1px solid #e2e8f0; color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $item)
                        <tr style="transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 20px 25px; border-bottom: 1px solid #f1f5f9;">
                                <div style="font-weight: 700; color: #1e293b; font-size: 15px;">{{ $item->name }}</div>
                                <div style="font-size: 12px; color: #94a3b8; font-family: monospace;">slug: {{ $item->slug }}</div>
                            </td>
                            <td style="padding: 20px; border-bottom: 1px solid #f1f5f9;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <img src="{{ $item->banner ? asset('storage/'.$item->banner) : asset('images/no-image.png') }}" style="width: 50px; height: 30px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                    <div style="width: 32px; height: 32px; background: #f8fafc; border-radius: 6px; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0;">
                                        <img src="{{ $item->icon ? asset('storage/'.$item->icon) : asset('images/no-image.png') }}" style="width: 18px; height: 18px; object-fit: contain;">
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 20px; border-bottom: 1px solid #f1f5f9;">
                                @if($item->status)
                                    <span style="background: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center;">
                                        <span style="width: 6px; height: 6px; background: #22c55e; border-radius: 50%; margin-right: 6px;"></span> Active
                                    </span>
                                @else
                                    <span style="background: #fee2e2; color: #991b1b; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center;">
                                        <span style="width: 6px; height: 6px; background: #ef4444; border-radius: 50%; margin-right: 6px;"></span> Inactive
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 20px 25px; border-bottom: 1px solid #f1f5f9; text-align: right;">
                                <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                    {{-- Edit --}}
                                    <a href="{{ route('category.edit', $item->id) }}" 
                                       style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: #eff6ff; color: #2563eb; text-decoration: none; transition: 0.2s;"
                                       onmouseover="this.style.background='#2563eb'; this.style.color='white';" 
                                       onmouseout="this.style.background='#eff6ff'; this.style.color='#2563eb';">
                                        <i class="btn btn-sm btn-primary me-1 mb-1"></i>
                                    </a>
                                    {{-- Delete --}}
                                    <form action="{{ route('category.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove this category?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: #fef2f2; color: #dc2626; border: none; transition: 0.2s;"
                                                onmouseover="this.style.background='#dc2626'; this.style.color='white';" 
                                                onmouseout="this.style.background='#fef2f2'; this.style.color='#dc2626';">
                                            <i class="btn btn-sm btn-danger mb-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 50px; text-align: center; color: #94a3b8; font-style: italic;">
                                <img src="{{ asset('images/empty-box.png') }}" style="width: 60px; opacity: 0.5; margin-bottom: 15px; display: block; margin-left: auto; margin-right: auto;">
                                No categories found. Start by adding one!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#cat_name').on('input', function() {
        let slug = $(this).val().toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
        $('#cat_slug').val(slug);
    });

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