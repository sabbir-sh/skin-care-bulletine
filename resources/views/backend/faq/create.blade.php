@extends('backend.layouts.app')

@section('title', isset($faq) ? 'Edit FAQ' : 'Add FAQ')

@section('content')
<div class="container-fluid" style="padding: 30px 45px; background-color: #f4f7f6; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form action="{{ isset($faq) ? route('faq.update', $faq->id) : route('faq.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($faq)) @method('PATCH') @endif

                {{-- Header Section --}}
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; background: white; padding: 25px; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                    <div>
                        <h3 style="font-weight: 800; color: #1a202c; margin-bottom: 5px; letter-spacing: -0.5px;">
                            {{ isset($faq) ? 'Update FAQ' : 'Create New FAQ' }}
                        </h3>
                        <p style="color: #718096; font-size: 14px; margin-bottom: 0;">{{ isset($faq) ? 'Update existing FAQ information' : 'Add a new question and answer to your system' }}</p>
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <a href="{{ route('faq.list') }}" class="btn" 
                           style="border-radius: 10px; padding: 10px 25px; font-weight: 600; border: 1px solid #e2e8f0; color: #4a5568; background: white;">Back</a>
                        <button type="submit" class="btn btn-success" 
                                style="border-radius: 10px; padding: 10px 25px; font-weight: 600; background-color: #2f855a; border: none; box-shadow: 0 4px 12px rgba(47, 133, 90, 0.2);">
                            <i class="fas fa-save me-2"></i> {{ isset($faq) ? 'Update FAQ' : 'Save FAQ' }}
                        </button>
                    </div>
                </div>

                <div class="row">
                    {{-- Main Content Box --}}
                    <div class="col-lg-12">
                        <div style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden;">
                            <div style="padding: 20px 30px; border-bottom: 1px solid #f7fafc; background: #fafcfe;">
                                <h6 style="margin: 0; font-weight: 700; color: #2d3748;">FAQ Details</h6>
                            </div>
                            <div style="padding: 35px;">
                                <div class="row g-4">
                                    {{-- Question --}}
                                    <div class="col-12" style="margin-bottom: 25px;">
                                        <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Question <span style="color: #e53e3e;">*</span></label>
                                        <input type="text" name="question" 
                                               style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; transition: 0.3s; font-size: 15px;"
                                               onfocus="this.style.borderColor='#48bb78'" onblur="this.style.borderColor='#edf2f7'"
                                               placeholder="e.g. How can I track my order?"
                                               value="{{ old('question', $faq->question ?? '') }}" required>
                                    </div>

                                    {{-- Answer --}}
                                    <div class="col-12" style="margin-bottom: 25px;">
                                        <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Answer <span style="color: #e53e3e;">*</span></label>
                                        <textarea name="answer" rows="5"
                                                  style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; transition: 0.3s; font-size: 15px; resize: none;"
                                                  onfocus="this.style.borderColor='#48bb78'" onblur="this.style.borderColor='#edf2f7'"
                                                  placeholder="Provide a detailed answer here..."
                                                  required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-4">
                                        <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Status</label>
                                        <select name="status" style="width: 100%; padding: 12px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; background: white; font-size: 14px;">
                                            <option value="1" {{ old('status', $faq->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $faq->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    {{-- Image Upload --}}
                                    <div class="col-md-8">
                                        <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Related Image (Optional)</label>
                                        <div style="display: flex; align-items: center; gap: 20px;">
                                            <input type="file" name="image" 
                                                   style="flex: 1; padding: 10px; border-radius: 10px; border: 2px dashed #edf2f7; font-size: 13px; color: #718096;">
                                            
                                            @if(isset($faq) && $faq->image)
                                                <div style="position: relative;">
                                                    <img src="{{ $faq->image_url }}"
                                                         style="width: 70px; height: 70px; object-fit: cover; border-radius: 10px; border: 2px solid #edf2f7; box-shadow: 0 4px 6px rgba(0,0,0,0.05);"
                                                         onerror="this.style.display='none'">
                                                    <span style="position: absolute; top: -10px; right: -10px; background: #2f855a; color: white; font-size: 9px; padding: 2px 6px; border-radius: 20px;">Current</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div style="margin-top: 40px; padding-top: 25px; border-top: 1px solid #f7fafc; display: flex; gap: 10px;">
                                    <button type="submit" class="btn btn-success" 
                                            style="border-radius: 10px; padding: 12px 30px; font-weight: 700; background-color: #2f855a; border: none;">
                                        {{ isset($faq) ? 'Update FAQ' : 'Create FAQ' }}
                                    </button>
                                    <a href="{{ route('faq.list') }}" class="btn" 
                                       style="border-radius: 10px; padding: 12px 30px; font-weight: 700; color: #718096;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection