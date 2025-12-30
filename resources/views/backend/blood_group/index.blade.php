@extends('backend.layouts.app')

@section('content')
<div class="container-fluid" style="padding: 30px 45px; background-color: #f4f7f6; min-height: 100vh;">
    
    {{-- Header Section --}}
    <div style="margin-bottom: 30px; background: white; padding: 25px; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
        <h3 style="font-weight: 800; color: #1a202c; margin-bottom: 5px; letter-spacing: -0.5px;">Blood Group Settings</h3>
        <p style="color: #718096; font-size: 14px; margin-bottom: 0;">Manage available blood groups for donors and patients.</p>
    </div>

    <div class="row g-4">
        {{-- Left: Form --}}
        <div class="col-lg-4">
            <div style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden; position: sticky; top: 30px;">
                <div style="padding: 20px 25px; border-bottom: 1px solid #f7fafc; background: #fafcfe;">
                    <h6 style="margin: 0; font-weight: 700; color: #2d3748;">
                        {{ isset($editItem) ? 'Edit Blood Group' : 'Add New Group' }}
                    </h6>
                </div>

                <div style="padding: 25px;">
                    <form method="POST" action="{{ isset($editItem) ? route('blood-group.update', $editItem->id) : route('blood-group.store') }}">
                        @csrf
                        @isset($editItem) @method('PATCH') @endisset

                        {{-- Name --}}
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Group Name <span style="color: #e53e3e;">*</span></label>
                            <input type="text" id="bgName" name="name" 
                                   style="width: 100%; padding: 10px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; transition: 0.3s;"
                                   onfocus="this.style.borderColor='#48bb78'" onblur="this.style.borderColor='#edf2f7'"
                                   class="@error('name') is-invalid @enderror"
                                   value="{{ old('name', $editItem->name ?? '') }}" placeholder="e.g. A+, O-" required>
                            @error('name') <small style="color: #e53e3e; font-size: 12px;">{{ $message }}</small> @enderror
                        </div>

                        {{-- Slug --}}
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Slug</label>
                            <input type="text" id="bgSlug" name="slug" 
                                   style="width: 100%; padding: 10px 15px; border-radius: 10px; border: 2px solid #edf2f7; background: #f8fafc; color: #718096;"
                                   value="{{ old('slug', $editItem->slug ?? '') }}" placeholder="auto-generated">
                        </div>

                        {{-- Title --}}
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Title (SEO)</label>
                            <input type="text" name="title" 
                                   style="width: 100%; padding: 10px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none;"
                                   value="{{ old('title', $editItem->title ?? '') }}" placeholder="e.g. A Positive Blood Group">
                        </div>

                        {{-- Description --}}
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Description</label>
                            <textarea name="description" rows="3" 
                                      style="width: 100%; padding: 10px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; resize: none;">{{ old('description', $editItem->description ?? '') }}</textarea>
                        </div>

                        {{-- Status --}}
                        <div style="margin-bottom: 25px;">
                            <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 8px; font-size: 13px;">Status</label>
                            <select name="status" style="width: 100%; padding: 10px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; background: white;">
                                <option value="1" {{ old('status', $editItem->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $editItem->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button class="btn btn-success w-100" 
                                style="border-radius: 12px; padding: 12px; font-weight: 700; background: #2f855a; border: none; box-shadow: 0 4px 12px rgba(47, 133, 90, 0.2);">
                            {{ isset($editItem) ? 'Update Group' : 'Save Group' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Right: Table --}}
        <div class="col-lg-8">
            <div style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden;">
                <div style="padding: 20px 25px; border-bottom: 1px solid #f7fafc; background: #fafcfe;">
                    <h6 style="margin: 0; font-weight: 700; color: #2d3748;">Blood Group List</h6>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: #f8fafc;">
                            <tr>
                                <th style="padding: 15px 25px; border: none; font-size: 12px; text-transform: uppercase; color: #718096;">Name</th>
                                <th style="padding: 15px; border: none; font-size: 12px; text-transform: uppercase; color: #718096;">Slug</th>
                                <th style="padding: 15px; border: none; font-size: 12px; text-transform: uppercase; color: #718096;">Status</th>
                                <th style="padding: 15px 25px; border: none; font-size: 12px; text-transform: uppercase; color: #718096; text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bloodGroups as $item)
                                <tr>
                                    <td style="padding: 15px 25px;">
                                        <span style="font-weight: 800; color: #2d3748; font-size: 16px; background: #f0f4f8; padding: 5px 12px; border-radius: 8px;">{{ $item->name }}</span>
                                    </td>
                                    <td style="color: #718096; font-size: 14px;">{{ $item->slug }}</td>
                                    <td>
                                        <span style="padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; 
                                              background: {{ $item->status ? '#f0fff4' : '#fff5f5' }}; 
                                              color: {{ $item->status ? '#2f855a' : '#c53030' }}; 
                                              border: 1px solid {{ $item->status ? '#c6f6d5' : '#fed7d7' }};">
                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td style="padding: 15px 25px; text-align: right;">
                                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                            <a href="{{ route('blood-group.edit', $item->id) }}" 
                                               style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background: #ebf8ff; color: #3182ce; text-decoration: none;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('blood-group.destroy', $item->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')" 
                                                        style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background: #fff5f5; color: #e53e3e; border: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-4 text-muted">No blood groups found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const nameInput = document.getElementById('bgName');
    const slugInput = document.getElementById('bgSlug');

    nameInput.addEventListener('input', function () {
        @if(!isset($editItem))
            slugInput.value = this.value.toLowerCase()
                .trim()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        @endif
    });
</script>
@endpush