@extends('backend.layouts.app')

@section('title', isset($editItem) ? 'Edit Donor' : 'Add Donor')

@section('content')
<div class="container-fluid" style="padding: 30px 45px; background-color: #f4f7f6; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <form method="POST"
                  action="{{ isset($editItem) ? route('donor.update', $editItem->id) : route('donor.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @isset($editItem)
                    @method('PATCH')
                @endisset

                {{-- Header Section --}}
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; background: white; padding: 25px; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                    <div>
                        <h3 style="font-weight: 800; color: #1a202c; margin-bottom: 5px; letter-spacing: -0.5px;">
                            {{ isset($editItem) ? 'Edit Donor Profile' : 'Register New Donor' }}
                        </h3>
                        <p style="color: #718096; font-size: 14px; margin-bottom: 0;">
                            {{ isset($editItem) ? 'Update existing donor information' : 'Add a new donor to the blood directory' }}
                        </p>
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <a href="{{ route('donor.list') }}" class="btn" 
                           style="border-radius: 10px; padding: 10px 25px; font-weight: 600; border: 1px solid #e2e8f0; color: #4a5568; background: white;">
                            <i class="fas fa-arrow-left me-2"></i> Back
                        </a>
                        <button type="submit" class="btn btn-success" 
                                style="border-radius: 10px; padding: 10px 25px; font-weight: 600; background-color: #2f855a; border: none; box-shadow: 0 4px 12px rgba(47, 133, 90, 0.2);">
                            <i class="fas fa-save me-2"></i> {{ isset($editItem) ? 'Update Donor' : 'Save Donor' }}
                        </button>
                    </div>
                </div>

                {{-- Main Form Card --}}
                <div style="background: white; border-radius: 16px; border: 1px solid #eef2f1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden;">
                    <div style="padding: 20px 30px; border-bottom: 1px solid #f7fafc; background: #fafcfe;">
                        <h6 style="margin: 0; font-weight: 700; color: #2d3748;">Donor Personal & Location Information</h6>
                    </div>

                    <div style="padding: 35px;">
                        <div class="row g-4">
                            
                            {{-- Name --}}
                            <div class="col-md-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Full Name <span style="color: #e53e3e;">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $editItem->name ?? '') }}" 
                                       style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; font-size: 15px;" 
                                       placeholder="Enter donor's name" required>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Email Address <span style="color: #e53e3e;">*</span></label>
                                <input type="email" name="email" value="{{ old('email', $editItem->email ?? '') }}" 
                                       style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; font-size: 15px;" 
                                       placeholder="example@mail.com" required>
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Phone Number <span style="color: #e53e3e;">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone', $editItem->phone ?? '') }}" 
                                       style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; font-size: 15px;" 
                                       placeholder="017XXXXXXXX" required>
                            </div>

                            {{-- Blood Group --}}
                            <div class="col-md-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Blood Group <span style="color: #e53e3e;">*</span></label>
                                <select name="blood_group_id" style="width: 100%; padding: 12px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; background: white; font-size: 14px;" required>
                                    <option value="">Select Blood Group</option>
                                    @foreach($bloodGroups as $bg)
                                        <option value="{{ $bg->id }}" {{ old('blood_group_id', $editItem->blood_group_id ?? '') == $bg->id ? 'selected' : '' }}>{{ $bg->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- DOB --}}
                            <div class="col-md-4">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $editItem->date_of_birth ?? '') }}" 
                                       style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; font-size: 15px;">
                            </div>

                            {{-- Gender --}}
                            <div class="col-md-4">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Gender</label>
                                <select name="gender" style="width: 100%; padding: 12px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; background: white; font-size: 14px;">
                                    <option value="">Select Gender</option>
                                    @foreach(['Male','Female','Other'] as $gender)
                                        <option value="{{ $gender }}" {{ old('gender', $editItem->gender ?? '') == $gender ? 'selected' : '' }}>{{ $gender }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Last Donation --}}
                            <div class="col-md-4">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Last Donation Date</label>
                                <input type="date" name="last_donation_date" value="{{ old('last_donation_date', $editItem->last_donation_date ?? '') }}" 
                                       style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; font-size: 15px;">
                            </div>

                            {{-- District & Upazila --}}
                            <div class="col-md-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">District <span style="color: #e53e3e;">*</span></label>
                                <input type="text" name="district" value="{{ old('district', $editItem->district ?? '') }}" 
                                       style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; font-size: 15px;" 
                                       placeholder="Enter district" required>
                            </div>

                            <div class="col-md-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Upazila <span style="color: #e53e3e;">*</span></label>
                                <input type="text" name="upazila" value="{{ old('upazila', $editItem->upazila ?? '') }}" 
                                       style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; font-size: 15px;" 
                                       placeholder="Enter upazila" required>
                            </div>

                            {{-- Union & Village --}}
                            <div class="col-md-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Union</label>
                                <input type="text" name="union" value="{{ old('union', $editItem->union ?? '') }}" 
                                       style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; font-size: 15px;" 
                                       placeholder="Enter union name">
                            </div>

                            <div class="col-md-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Village</label>
                                <input type="text" name="village" value="{{ old('village', $editItem->village ?? '') }}" 
                                       style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; font-size: 15px;" 
                                       placeholder="Enter village name">
                            </div>

                            {{-- Image Upload --}}
                            <div class="col-md-6">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Donor Image</label>
                                <div style="display: flex; align-items: center; gap: 20px;">
                                    <input type="file" name="image" 
                                           style="flex: 1; padding: 10px; border-radius: 10px; border: 2px dashed #edf2f7; font-size: 13px; color: #718096;">
                                    
                                    @if(isset($editItem) && $editItem->image)
                                        <div style="position: relative;">
                                            <img src="{{ asset('storage/'.$editItem->image) }}"
                                                 style="width: 70px; height: 70px; object-fit: cover; border-radius: 10px; border: 2px solid #edf2f7; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Status & Availability --}}
                            <div class="col-md-3">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Status</label>
                                <select name="status" style="width: 100%; padding: 12px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; background: white; font-size: 14px;">
                                    <option value="1" {{ old('status', $editItem->status ?? 1) == 1 ? 'selected' : '' }}>Approved</option>
                                    <option value="0" {{ old('status', $editItem->status ?? 1) == 0 ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label style="display: block; font-weight: 700; color: #4a5568; margin-bottom: 10px; font-size: 14px;">Is Available</label>
                                <select name="is_available" style="width: 100%; padding: 12px; border-radius: 10px; border: 2px solid #edf2f7; outline: none; background: white; font-size: 14px;">
                                    <option value="1" {{ old('is_available', $editItem->is_available ?? 1) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('is_available', $editItem->is_available ?? 1) == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div style="margin-top: 40px; padding-top: 25px; border-top: 1px solid #f7fafc; display: flex; gap: 10px;">
                            <button type="submit" class="btn btn-success" 
                                    style="border-radius: 10px; padding: 12px 35px; font-weight: 700; background-color: #2f855a; border: none;">
                                <i class="fas fa-check-circle me-2"></i> {{ isset($editItem) ? 'Update Donor' : 'Create Donor' }}
                            </button>
                            <a href="{{ route('donor.list') }}" class="btn" 
                               style="border-radius: 10px; padding: 12px 35px; font-weight: 700; color: #718096; background: #f8fafc; border: 1px solid #e2e8f0;">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection