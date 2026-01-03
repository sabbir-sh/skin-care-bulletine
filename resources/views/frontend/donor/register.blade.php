@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="row g-0">

                    {{-- LEFT SIDE --}}
                    <div class="col-md-4 bg-danger d-flex align-items-center justify-content-center text-white p-4 text-center">
                        <div>
                            <i class="fas fa-hand-holding-heart fa-4x mb-3"></i>
                            <h2 class="fw-bold">Be a Fighter</h2>
                            <p class="mb-0">
                                Register as a blood donor and help save lives in your community.
                            </p>
                        </div>
                    </div>

                    {{-- RIGHT SIDE --}}
                    <div class="col-md-8 bg-white p-5">
                        <h4 class="mb-4 fw-bold">Donor Registration</h4>

                        {{-- SUCCESS MESSAGE --}}
                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- VALIDATION ERRORS --}}
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- FORM --}}
                        <form action="{{ route('donor.frontend.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">

                                {{-- NAME --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Full Name <span style="color: #e53e3e;">*</span></label>
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           value="{{ old('name') }}"
                                           placeholder="Full Name"
                                           required>
                                </div>

                                {{-- EMAIL --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email (Optional)</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           value="{{ old('email') }}"
                                           placeholder="Email"
                                           >
                                </div>

                                {{-- PHONE --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Phone Number <span style="color: #e53e3e;">*</span></label>
                                    <input type="number"
                                           name="phone"
                                           class="form-control"
                                           value="{{ old('phone') }}"
                                           placeholder="017XXXXXXXX"
                                           required>
                                </div>

                                {{-- Gender --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                           
                                {{-- DATE OF BIRTH --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Date of Birth <span style="color: #e53e3e;">*</span></label>
                                    <input type="date"
                                           name="date_of_birth"
                                           class="form-control"
                                           value="{{ old('date_of_birth') }}"
                                           placeholder="Date of Birth"
                                           required>
                                </div>

                                {{-- LAST DONATION DATE --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Last Donation Date (Optional)</label>
                                    <input type="date"
                                           name="last_donation_date"
                                           class="form-control"
                                           value="{{ old('last_donation_date') }}"
                                           placeholder="Last Donation Date"
                                           >
                                </div>

                                {{-- BLOOD GROUP --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Blood Group <span style="color: #e53e3e;">*</span></label>
                                    <select name="blood_group_id" class="form-select" required>
                                        <option value="">Select Group</option>
                                        @foreach($bloodGroups as $bg)
                                            <option value="{{ $bg->id }}"
                                                {{ old('blood_group_id') == $bg->id ? 'selected' : '' }}>
                                                {{ $bg->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- DISTRICT --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">District <span style="color: #e53e3e;">*</span></label>
                                    <input type="text"
                                           name="district"
                                           class="form-control"
                                           value="{{ old('district') }}"
                                           placeholder="District"
                                           required>
                                </div>

                                {{-- UPAZILA --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Upazila <span style="color: #e53e3e;">*</span></label>
                                    <input type="text"
                                           name="upazila"
                                           class="form-control"
                                           value="{{ old('upazila') }}"
                                           placeholder="Upazila"
                                           required>
                                </div>

                                {{-- UNION --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Union <span style="color: #e53e3e;">*</span></label>
                                    <input type="text"
                                           name="union"
                                           class="form-control"
                                           value="{{ old('union') }}"
                                           placeholder="Union"
                                           required >
                                </div>

                                {{-- VILLAGE --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Village <span style="color: #e53e3e;">*</span></label>
                                    <input type="text"
                                           name="village"
                                           class="form-control"
                                           value="{{ old('village') }}"
                                           placeholder="Village"
                                           required>
                                </div>

                                {{-- IMAGE --}}
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Profile Picture</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                {{-- SUBMIT --}}
                                <div class="col-12 mt-4">
                                    <button type="submit"
                                            class="btn btn-danger w-100 py-2 fw-bold shadow-sm"
                                            style="border-radius: 10px;">
                                        REGISTER AS DONOR
                                    </button>
                                </div>

                            </div>
                        </form>
                        {{-- END FORM --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INLINE STYLE --}}
<style>
    .form-control, .form-select {
        border: 2px solid #f1f3f5;
        padding: 12px;
        border-radius: 10px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #dc3545;
        box-shadow: none;
    }
</style>
@endsection
