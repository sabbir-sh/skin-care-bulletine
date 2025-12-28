@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Hind Siliguri', sans-serif;
            background-color: #f8f9fa;
        }

        .page-header {
            background: linear-gradient(135deg, #e63946 0%, #c1121f 100%);
            padding: 60px 0;
            color: white;
            margin-bottom: 50px;
            border-radius: 0 0 50px 50px;
        }

        .donor-card {
            border: none;
            border-radius: 25px;
            transition: all 0.4s ease;
            background: white;
            margin-top: 40px;
        }

        .donor-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .donor-img-wrapper {
            position: relative;
            margin-top: -55px;
        }

        .donor-img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .info-box {
            background: #fff5f5;
            border-radius: 15px;
            padding: 15px;
        }

        .btn-call {
            background: #e63946;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-call:hover {
            background: #c1121f;
            color: white;
            transform: scale(1.05);
        }
    </style>

    {{-- Header Section --}}
    <section class="page-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">
                {{ $selectedGroup->name }} গ্রুপের রক্তদাতা
            </h1>
            <p class="lead opacity-75 animate__animated animate__fadeInUp">
                বর্তমানে এই গ্রুপে মোট {{ $totalDonors }} জন দাতা পাওয়া গেছে
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}"
                            class="text-white text-decoration-none">হোম</a></li>
                    <li class="breadcrumb-item active text-white opacity-50" aria-current="page">{{ $selectedGroup->name }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container pb-5">
        <div class="row g-5">
            @forelse($recentDonors as $donor)
                <div class="col-lg-4 col-md-6">
                    <div class="card donor-card shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            {{-- Donor Image --}}
                            <div class="donor-img-wrapper mb-4">
                                <img src="{{ $donor->image ? asset('storage/' . $donor->image) : 'https://ui-avatars.com/api/?name=' . urlencode($donor->name) . '&background=E63946&color=fff&size=128' }}"
                                    class="rounded-circle donor-img" alt="Donor">
                                <span
                                    class="position-absolute bottom-0 translate-middle-x p-2 {{ $donor->is_available ? 'bg-success' : 'bg-secondary' }} border border-3 border-white rounded-circle"
                                    style="left: 60%;"
                                    title="{{ $donor->is_available ? 'Available' : 'Not Available' }}"></span>
                            </div>

                            <h3 class="fw-bold text-dark mb-1">{{ $donor->name }}</h3>
                            <div class="badge bg-danger fs-6 px-4 py-2 rounded-pill mb-4">
                                রক্তের গ্রুপ: {{ $donor->bloodGroup->name ?? 'N/A' }}
                            </div>

                            {{-- Details Info --}}
                            <div class="info-box text-start mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-envelope text-danger me-3"></i>
                                    <span class="small">{{ $donor->email }}</span>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <i class="fas fa-venus-mars text-danger me-2"></i> {{ ucfirst($donor->gender) }}
                                    </div>
                                    <div class="col-6 text-end">
                                        <i class="fas fa-birthday-cake text-danger me-2"></i>
                                        {{ $donor->date_of_birth ? \Carbon\Carbon::parse($donor->date_of_birth)->age : '??' }}
                                        বছর
                                    </div>
                                </div>
                                <div class="pt-2 border-top">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    {{ $donor->upazila }}, {{ $donor->district }}
                                </div>
                            </div>

                            <div
                                class="alert {{ $donor->is_available ? 'alert-success' : 'alert-warning' }} py-2 small fw-bold">
                                শেষ দান: {{ $donor->last_donation_date ?? 'তথ্য নেই' }}
                            </div>

                            {{-- Call Button --}}
                            <div class="mt-4">
                                <a href="tel:{{ $donor->phone }}" class="btn btn-call btn-lg w-100 rounded-pill shadow">
                                    <i class="fas fa-phone-alt me-2"></i> এখনই কল দিন
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="card shadow-sm p-5 rounded-4">
                        <i class="fas fa-user-slash fa-4x text-muted mb-4"></i>
                        <h3 class="text-muted">দুঃখিত! এই গ্রুপে বর্তমানে কোনো রক্তদাতার তথ্য নেই।</h3>
                        <div class="mt-4">
                            <a href="{{ route('frontend.home') }}" class="btn btn-danger rounded-pill px-4">অন্যান্য গ্রুপ
                                দেখুন</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection