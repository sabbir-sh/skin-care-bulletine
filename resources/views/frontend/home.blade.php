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

        :root {
            --primary-red: #e63946;
            --dark-red: #c1121f;
            --glass-white: rgba(255, 255, 255, 0.8);
        }

        /* --- 3D Hero Section --- */
        .hero-section {
            background: linear-gradient(135deg, #fff0f0 0%, #ffcccc 100%);
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            color: var(--primary-red);
            text-shadow: 5px 5px 15px rgba(230, 57, 70, 0.3);
            line-height: 1.2;
        }

        .animate-3d-text {
            display: inline-block;
            animation: floating 3s ease-in-out infinite;
            transform-style: preserve-3d;
        }

        @keyframes floating {
            0% {
                transform: translatey(0px) rotateX(0deg);
            }

            50% {
                transform: translatey(-20px) rotateX(10deg);
            }

            100% {
                transform: translatey(0px) rotateX(0deg);
            }
        }

        /* --- Donor Card Design --- */
        .donor-card {
            border: none;
            border-radius: 25px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: var(--glass-white);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .donor-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(230, 57, 70, 0.15) !important;
        }

        .donor-img-wrapper {
            position: relative;
            margin-top: -50px;
        }

        .donor-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .info-box {
            background: #fdf2f2;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
        }

        /* --- নতুন বক্স স্টাইল (Blood Group Boxes) --- */
        .blood-group-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 15px;
            padding: 20px 10px;
            transition: all 0.3s ease;
            text-align: center;
            display: block;
            text-decoration: none !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
            height: 100%;
        }

        .blood-group-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-red);
            box-shadow: 0 10px 25px rgba(230, 57, 70, 0.1);
        }

        .blood-group-card.active-group {
            background: var(--primary-red);
            border-color: var(--primary-red);
        }

        .group-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-red);
            margin-bottom: 5px;
            display: block;
        }

        .active-group .group-name,
        .active-group .group-count {
            color: white !important;
        }

        .group-count {
            font-size: 0.85rem;
            color: #666;
            font-weight: 600;
            background: #f8f9fa;
            padding: 2px 10px;
            border-radius: 50px;
            display: inline-block;
        }

        .active-group .group-count {
            background: rgba(255, 255, 255, 0.2);
        }

        /* --- Responsive adjustments --- */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .hero-section {
                padding: 80px 0;
            }

            .group-name {
                font-size: 1.4rem;
            }
        }

        .btn-massive {
            padding: 15px 40px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>

    <div class="main-wrapper">

        {{-- Hero Section --}}
        <section class="hero-section text-center">
            <div class="container">
                <h1 class="hero-title animate__animated animate__fadeInDown">
                    <span class="animate-3d-text">রক্তদানই</span> <br>
                    <span class="text-dark">জীবনের সেরা উপহার</span>
                </h1>
                <p class="fs-4 text-muted mt-4 animate__animated animate__fadeInUp animate__delay-1s px-md-5">
                    আপনার এক ব্যাগ রক্তে বেঁচে যেতে পারে একটি হাসি। আপনিও হতে পারেন একজন জীবন রক্ষাকারী নায়ক।
                </p>
                <div class="mt-5 animate__animated animate__zoomIn animate__delay-2s">
                    <a href="#donors" class="btn btn-danger btn-massive shadow-lg">রক্তদাতার তালিকা দেখুন</a>
                </div>
            </div>
        </section>

        <div class="container py-5 mt-5" id="donors">
            {{-- Section Header --}}
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark">আমাদের বীর রক্তদাতারা</h2>
                <div class="bg-danger mx-auto" style="width: 80px; height: 5px; border-radius: 5px;"></div>
            </div>

            <div class="row g-5">
                @foreach($recentDonors as $donor)
                    <div class="col-lg-4 col-md-6">
                        <div class="card donor-card shadow-sm h-100">
                            <div class="card-body p-4 pt-5 text-center">
                                <div class="donor-img-wrapper mb-4">
                                    <img src="{{ $donor->image ? asset('storage/' . $donor->image) : 'https://ui-avatars.com/api/?name=' . urlencode($donor->name) . '&background=E63946&color=fff&size=128' }}"
                                        class="rounded-circle donor-img" alt="Donor">
                                    <span
                                        class="position-absolute bottom-0 translate-middle-x p-2 {{ $donor->is_available ? 'bg-success' : 'bg-secondary' }} border border-3 border-white rounded-circle"
                                        style="left: 60%;" title="Available Status"></span>
                                </div>

                                <h3 class="fw-bold text-dark mb-1">{{ $donor->name }}</h3>
                                <div class="badge bg-danger fs-6 px-4 py-2 rounded-pill mb-4">
                                    রক্তের গ্রুপ: {{ $donor->bloodGroup->name ?? 'N/A' }}
                                </div>

                                <div class="info-box text-start">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-danger me-3 fs-5"></i>
                                        <span class="fs-6">{{ $donor->email }}</span>
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

                                <div class="mt-4">
                                    <a href="tel:{{ $donor->phone }}" class="btn btn-danger btn-lg w-100 rounded-pill shadow">
                                        <i class="fas fa-phone-alt me-2"></i> এখনই কল দিন
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Blood Groups Grid --}}
            <section class="my-5 py-5" id="blood-groups">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold">রক্তের গ্রুপ অনুযায়ী খুঁজুন</h2>
                    @isset($selectedGroup)
                        <p class="text-muted">
                            <span class="badge bg-danger px-3 py-2 fs-6 rounded-pill">{{ $selectedGroup->name }}</span> গ্রুপের
                            দাতারা দেখানো হচ্ছে
                        </p>
                    @endisset
                </div>

                <div class="row g-3 g-md-4 justify-content-center">
                    @foreach($bloodGroups as $bg)
                        <div class="col-6 col-md-3 col-lg-2">
                            <a href="{{ route('blood.group', $bg->slug) }}"
                                class="blood-group-card {{ ($activeGroup === $bg->slug) ? 'active-group' : '' }}">
                                <span class="group-name">{{ $bg->name }}</span>
                                <span class="group-count">দাতা: {{ $bg->donors_count }} জন</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- FAQ Section --}}
            <section class="row justify-content-center py-5">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg p-4 p-md-5 rounded-4">
                        <h2 class="text-center fw-bold mb-5">সাধারণ জিজ্ঞাসা (FAQ)</h2>
                        <div class="accordion accordion-flush" id="faqAccordion">
                            @foreach($faqs as $faq)
                                <div class="accordion-item mb-3 border rounded-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fs-5 fw-bold py-3" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body fs-6 leading-relaxed">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
@endsection