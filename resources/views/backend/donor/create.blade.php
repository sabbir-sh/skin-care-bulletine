@extends('backend.layouts.app')

@section('title', isset($editItem) ? 'Edit Donor' : 'Add Donor')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
        <div>
            <h3 class="fw-bold mb-1">
                {{ isset($editItem) ? 'Edit' : 'Add' }} Donor
            </h3>
            <small class="text-muted">
                {{ isset($editItem) ? 'Update existing donor information' : 'Create a new donor' }}
            </small>
        </div>

        <a href="{{ route('donor.list') }}" class="btn btn-outline-secondary rounded-pill px-4 mt-2 mt-md-0">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    {{-- Card --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form method="POST"
                  action="{{ isset($editItem) ? route('donor.update', $editItem->id) : route('donor.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @isset($editItem)
                    @method('PATCH')
                @endisset

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $editItem->name ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $editItem->email ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone', $editItem->phone ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control"
                               value="{{ old('date_of_birth', $editItem->date_of_birth ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $editItem->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $editItem->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $editItem->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Last Donation Date</label>
                        <input type="date" name="last_donation_date" class="form-control"
                               value="{{ old('last_donation_date', $editItem->last_donation_date ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Blood Group <span class="text-danger">*</span></label>
                        <select name="blood_group_id" class="form-select" required>
                            <option value="">Select Blood Group</option>
                            @foreach($bloodGroups as $bg)
                                <option value="{{ $bg->id }}"
                                    {{ old('blood_group_id', $editItem->blood_group_id ?? '') == $bg->id ? 'selected' : '' }}>
                                    {{ $bg->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">District <span class="text-danger">*</span></label>
                        <select name="district" id="district" class="form-select" required>
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district['name'] }}"
                                    {{ old('district', $editItem->district ?? '') == $district['name'] ? 'selected' : '' }}>
                                    {{ $district['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Upazila <span class="text-danger">*</span></label>
                        <select name="upazila" id="upazila" class="form-select" required>
                            <option value="">Select Upazila</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Image</label>
                        <input type="file" name="image" class="form-control">
                        @if(isset($editItem) && $editItem->image)
                            <img src="{{ asset('storage/'.$editItem->image) }}" width="80" class="mt-2 rounded">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ old('status', $editItem->status ?? 1) == 1 ? 'selected' : '' }}>Approved</option>
                            <option value="0" {{ old('status', $editItem->status ?? 1) == 0 ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Is Available</label>
                        <select name="is_available" class="form-select">
                            <option value="1" {{ old('is_available', $editItem->is_available ?? 1) == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_available', $editItem->is_available ?? 1) == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4 rounded-pill">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ isset($editItem) ? 'Update Donor' : 'Save Donor' }}
                    </button>
                    <a href="{{ route('donor.list') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@push('scripts')
<script>
    const districts = @json($districts);
    const upazilas = @json($upazilas);
    const districtSelect = document.getElementById('district');
    const upazilaSelect = document.getElementById('upazila');

    function populateUpazilas(selectedDistrict, selectedUpazila=null){
        upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
        const districtObj = districts.find(d => d.name === selectedDistrict);
        if(!districtObj) return;
        const filtered = upazilas.filter(u => u.district_id == districtObj.id);
        filtered.forEach(u => {
            const opt = document.createElement('option');
            opt.value = u.name;
            opt.text = u.name;
            if(selectedUpazila && selectedUpazila == u.name) opt.selected = true;
            upazilaSelect.appendChild(opt);
        });
    }

    districtSelect.addEventListener('change', function(){
        populateUpazilas(this.value);
    });

    @if(old('district', $editItem->district ?? false))
        populateUpazilas('{{ old("district", $editItem->district) }}', '{{ old("upazila", $editItem->upazila ?? "") }}');
    @endif
</script>
@endpush
@endsection