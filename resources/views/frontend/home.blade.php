@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="main-wrapper" style="font-family: 'Hind Siliguri', sans-serif; background-color: #f8f9fa;">

        <section class="hero-section text-center"
            style="background: linear-gradient(135deg, #fff0f0 0%, #ffcccc 100%); padding: 100px 0; position: relative; overflow: hidden;">
            <div class="container">
                <h1 class="animate__animated animate__fadeInDown"
                    style="font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 800; color: #e63946; text-shadow: 5px 5px 15px rgba(230, 57, 70, 0.3); line-height: 1.2;">
                    <span style="display: inline-block; animation: floating 3s ease-in-out infinite;">রক্তদানই</span> <br>
                    <span style="color: #212529;">জীবনের সেরা উপহার</span>
                </h1>
                <p class="fs-4 text-muted mt-4 animate__animated animate__fadeInUp animate__delay-1s px-md-5">
                    আপনার এক ব্যাগ রক্তে বেঁচে যেতে পারে একটি হাসি। আপনিও হতে পারেন একজন জীবন রক্ষাকারী নায়ক।
                </p>
                <div class="mt-5 animate__animated animate__zoomIn animate__delay-2s">
                    <a href="#donors" class="btn btn-danger shadow-lg"
                        style="padding: 15px 40px; font-size: 1.2rem; font-weight: 700; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px;">
                        রক্তদাতার তালিকা দেখুন
                    </a>
                </div>
            </div>

            <style>
                @keyframes floating {

                    0%,
                    100% {
                        transform: translateY(0px);
                    }

                    50% {
                        transform: translateY(-20px);
                    }
                }
            </style>
        </section>

        <div class="container py-5 mt-5" id="donors">

            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark">আমাদের বীর রক্তদাতারা</h2>
                <div
                    style="background: linear-gradient(90deg, transparent, #dc3545, transparent); margin: 10px auto; width: 120px; height: 5px; border-radius: 5px;">
                </div>
            </div>

            {{-- সার্চ সেকশন --}}
            <div class="container mb-5">
                <div class="card border-0 shadow-sm" style="border-radius: 30px; background: #ffffff; overflow: hidden;">
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('frontend.home') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-lg-3 col-md-6">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-light border-0" style="border-radius: 15px 0 0 15px;">
                                            <i class="fas fa-map-marker-alt text-danger"></i>
                                        </span>
                                        <input type="text" name="district" value="{{ request('district') }}" 
                                            class="form-control bg-light border-0 shadow-none" placeholder="জেলা" 
                                            style="border-radius: 0 15px 15px 0; height: 55px; font-weight: 500;">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-light border-0" style="border-radius: 15px 0 0 15px;">
                                            <i class="fas fa-city text-danger"></i>
                                        </span>
                                        <input type="text" name="upazila" value="{{ request('upazila') }}" 
                                            class="form-control bg-light border-0 shadow-none" placeholder="উপজেলা" 
                                            style="border-radius: 0 15px 15px 0; height: 55px; font-weight: 500;">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-6">
                                    <input type="text" name="union" value="{{ request('union') }}" 
                                        class="form-control bg-light border-0 shadow-none" placeholder="ইউনিয়ন" 
                                        style="border-radius: 15px; height: 55px; font-weight: 500;">
                                </div>

                                <div class="col-lg-2 col-md-6">
                                    <input type="text" name="village" value="{{ request('village') }}" 
                                        class="form-control bg-light border-0 shadow-none" placeholder="গ্রাম" 
                                        style="border-radius: 15px; height: 55px; font-weight: 500;">
                                </div>

                                <div class="col-lg-2 col-md-12">
                                    <button type="submit" class="btn btn-danger w-100 shadow-sm d-flex align-items-center justify-content-center" 
                                        style="border-radius: 15px; height: 55px; background: linear-gradient(45deg, #dc3545, #ff4d5a); border: none; font-weight: 700; font-size: 1.1rem; transition: 0.3s;">
                                        <i class="fas fa-search me-2"></i> খুঁজুন
                                    </button>
                                </div>
                            </div>

                            {{-- ফিল্টার ক্লিয়ার বাটন (যদি কোনো ফিল্টার সক্রিয় থাকে) --}}
                            @if(request()->anyFilled(['district', 'upazila', 'union', 'village']))
                                <div class="text-center mt-4">
                                    <a href="{{ route('frontend.home') }}" class="text-decoration-none" style="color: #6c757d; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-times-circle me-1"></i> সার্চ ক্লিয়ার করুন
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            {{-- কার্ড সেকশন --}}
            <div class="row g-4">
                @forelse($recentDonors as $donor)
                    {{-- আপনার আগের কার্ডের কোড এখানে থাকবে --}}
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">দুঃখিত, এই এলাকায় কোনো রক্তদাতা পাওয়া যায়নি।</h4>
                    </div>
                @endforelse
            </div>

            <div class="row g-4">
                @foreach($recentDonors as $donor)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0"
                            style="border-radius: 25px; transition: all 0.3s ease; overflow: hidden; background: #ffffff;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 35px rgba(220, 53, 69, 0.12)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.05)'">

                            <div class="card-body p-4 text-center d-flex flex-column">
                                
                                {{-- প্রোফাইল ইমেজ সেকশন --}}
                                <div style="position: relative; width: 140px; height: 140px; margin: 0 auto 20px;">
                                    @php
                                        $imageUrl = $donor->image ? asset('storage/' . $donor->image) : 'https://ui-avatars.com/api/?name=' . urlencode($donor->name) . '&background=f8d7da&color=dc3545&size=200';
                                    @endphp

                                    <div style="width: 100%; height: 100%; border-radius: 50%; padding: 4px; background: linear-gradient(45deg, #dc3545, #ffccd5);">
                                        <img src="{{ $imageUrl }}"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 3px solid #fff;"
                                            alt="{{ $donor->name }}">
                                    </div>

                                    {{-- অনলাইন স্ট্যাটাস ডট --}}
                                    <span style="position: absolute; bottom: 8px; right: 8px; width: 20px; height: 20px; background: {{ $donor->is_available ? '#28a745' : '#adb5bd' }}; border: 3px solid #fff; border-radius: 50%; z-index: 2;"></span>
                                </div>

                                {{-- ব্লাড গ্রুপ ব্যাজ --}}
                                <div class="mb-3">
                                    <span style="background: rgba(220, 53, 69, 0.1); color: #dc3545; padding: 6px 16px; border-radius: 50px; font-weight: 700; font-size: 0.85rem; border: 1px solid rgba(220, 53, 69, 0.2);">
                                        <i class="fas fa-tint me-1"></i> গ্রুপ: {{ $donor->bloodGroup->name ?? 'N/A' }}
                                    </span>
                                </div>

                                <h4 class="fw-bold text-dark mb-1">{{ $donor->name }}</h4>
                                
                                <p class="small mb-3" style="font-weight: 600; color: {{ $donor->is_available ? '#28a745' : '#6c757d' }};">
                                    {{ $donor->is_available ? '● রক্তদানে ইচ্ছুক' : '● আপাতত ব্যস্ত' }}
                                </p>

                                {{-- কন্টাক্ট ইনফরমেশন বক্স --}}
                                <div style="background: #f8f9fa; border-radius: 18px; padding: 15px; text-align: left; margin-bottom: 20px; border: 1px solid #eee; flex-grow: 1;">
                                    
                                    {{-- Email logic: থাকলে দেখাবে, না থাকলে N/A --}}
                                    <div style="font-size: 0.85rem; color: #555; margin-bottom: 8px; padding-bottom: 8px; border-bottom: 1px solid #e9ecef;">
                                        <i class="fas fa-envelope text-danger me-2" style="width: 15px;"></i> 
                                        {{ $donor->email ?? 'N/A' }}
                                    </div>

                                    <div class="d-flex justify-content-between mb-2" style="font-size: 0.85rem; color: #555;">
                                        <span><i class="fas fa-venus-mars text-danger me-2"></i>{{ ucfirst($donor->gender) }}</span>
                                        <span><i class="fas fa-calendar-alt text-danger me-1"></i> {{ $donor->date_of_birth ? \Carbon\Carbon::parse($donor->date_of_birth)->age : '??' }} বছর</span>
                                    </div>

                                    <div style="font-size: 0.82rem; color: #666; line-height: 1.5;">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        {{ $donor->village ? $donor->village.', ' : '' }} {{ $donor->upazila }}, {{ $donor->district }}
                                    </div>
                                </div>

                                {{-- লাস্ট ডোনেশন স্ট্যাটাস --}}
                                <div style="font-size: 0.8rem; font-weight: 600; color: #444; margin-bottom: 15px;">
                                    <i class="far fa-clock me-1 text-primary"></i> শেষ রক্তদান: 
                                    <span class="text-dark">{{ $donor->last_donation_date ?? 'নতুন ডোনার' }}</span>
                                </div>

                                {{-- কল বাটন --}}
                                <div class="mt-auto">
                                    <a href="tel:{{ $donor->phone }}" class="btn btn-danger w-100 py-2 fw-bold shadow-sm"
                                        style="border-radius: 12px; background: #dc3545; border: none; transition: 0.3s;">
                                        <i class="fas fa-phone-alt me-2"></i> কল করুন
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <section class="my-5 py-5" id="blood-groups">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold">রক্তের গ্রুপ অনুযায়ী খুঁজুন</h2>
                    @isset($selectedGroup)
                        <p class="text-muted mt-2">
                            <span class="badge bg-danger px-3 py-2 fs-6 rounded-pill">{{ $selectedGroup->name }}</span> গ্রুপের
                            দাতারা দেখানো হচ্ছে
                        </p>
                    @endisset
                </div>

                <div class="row g-3 g-md-4 justify-content-center">
                    @foreach($bloodGroups as $bg)
                        <div class="col-6 col-md-3 col-lg-2">
                            @php $isActive = ($activeGroup === $bg->slug); @endphp
                            <a href="{{ route('blood.group', $bg->slug) }}"
                                style="background: {{ $isActive ? '#e63946' : 'white' }}; border: 1px solid {{ $isActive ? '#e63946' : '#eee' }}; border-radius: 15px; padding: 20px 10px; transition: all 0.3s ease; text-align: center; display: block; text-decoration: none; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);"
                                onmouseover="this.style.transform='translateY(-5px)'; this.style.borderColor='#e63946'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='{{ $isActive ? '#e63946' : '#eee' }}'">
                                <span
                                    style="font-size: 1.8rem; font-weight: 800; color: {{ $isActive ? 'white' : '#e63946' }}; display: block;">{{ $bg->name }}</span>
                                <span
                                    style="font-size: 0.85rem; color: {{ $isActive ? 'white' : '#666' }}; font-weight: 600; background: {{ $isActive ? 'rgba(255,255,255,0.2)' : '#f8f9fa' }}; padding: 2px 10px; border-radius: 50px; display: inline-block;">
                                    দাতা: {{ $bg->donors_count }} জন
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

            <style>
                @keyframes float {
                    0% {
                        transform: translateY(0px);
                    }

                    50% {
                        transform: translateY(-10px);
                    }

                    100% {
                        transform: translateY(0px);
                    }
                }

                .floating-card {
                    animation: float 4s ease-in-out infinite;
                }

                .counter-card {
                    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                    border: 1px solid rgba(0, 0, 0, 0.05);
                }

                .counter-card:hover {
                    transform: translateY(-15px) scale(1.02);
                    box-shadow: 0 20px 40px rgba(220, 53, 69, 0.1) !important;
                }

                .icon-circle {
                    transition: all 0.5s ease;
                }

                .counter-card:hover .icon-circle {
                    transform: rotateY(180deg);
                }
            </style>

            <section class="py-5" style="background: linear-gradient(to bottom, #ffffff, #fcfcfc);">
                <div class="container">
                    <div class="row g-4 justify-content-center">

                        <div class="col-6 col-md-3 floating-card">
                            <div class="counter-card text-center p-4 shadow-sm bg-white h-100" style="border-radius: 30px;">
                                <div class="icon-circle mb-3 mx-auto"
                                    style="width: 80px; height: 80px; background: #fff5f5; border-radius: 25px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-users fa-2x text-danger"></i>
                                </div>
                                <h2 class="counter-value fw-black mb-1" data-target="{{ $total_donors }}"
                                    style="color: #2d3436; font-size: 2.8rem; letter-spacing: -1px;">0</h2>
                                <p class="text-uppercase small fw-bold text-muted mb-0" style="letter-spacing: 1px;">Total
                                    Donors</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 floating-card" style="animation-delay: 0.5s;">
                            <div class="counter-card text-center p-4 shadow-sm bg-white h-100" style="border-radius: 30px;">
                                <div class="icon-circle mb-3 mx-auto"
                                    style="width: 80px; height: 80px; background: #f1fcf6; border-radius: 25px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-heartbeat fa-2x text-success"></i>
                                </div>
                                <h2 class="counter-value fw-black mb-1" data-target="{{ $available_donors }}"
                                    style="color: #2d3436; font-size: 2.8rem; letter-spacing: -1px;">0</h2>
                                <p class="text-uppercase small fw-bold text-muted mb-0" style="letter-spacing: 1px;">
                                    Available Now</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 floating-card" style="animation-delay: 1s;">
                            <div class="counter-card text-center p-4 shadow-sm bg-white h-100" style="border-radius: 30px;">
                                <div class="icon-circle mb-3 mx-auto"
                                    style="width: 80px; height: 80px; background: #fffdf2; border-radius: 25px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-droplet fa-2x text-warning"></i>
                                </div>
                                <h2 class="counter-value fw-black mb-1" data-target="{{ $total_groups }}"
                                    style="color: #2d3436; font-size: 2.8rem; letter-spacing: -1px;">0</h2>
                                <p class="text-uppercase small fw-bold text-muted mb-0" style="letter-spacing: 1px;">Blood
                                    Groups</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <a href="tel:01750512161" class="text-decoration-none d-block h-100">
                                <div class="counter-card text-center p-4 shadow-lg bg-danger text-white h-100 position-relative overflow-hidden"
                                    style="border-radius: 30px; background: linear-gradient(45deg, #d63031, #ff7675);">
                                    <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.1;">
                                        <i class="fas fa-phone-alt fa-6x"></i>
                                    </div>
                                    <div class="mb-3 mx-auto pulse-red"
                                        style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 25px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-headset fa-2x text-white"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1">Emergency</h4>
                                    <p class="small mb-3 text-white-50">Available 24/7</p>
                                    <span class="badge bg-white text-danger fw-bolder py-2 px-3 rounded-pill shadow-sm"
                                        style="font-size: 1rem;">
                                        <i class="fas fa-phone-volume me-2"></i>01750512161
                                    </span>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </section>

            {{-- CEO Message Section --}}
            <section class="row justify-content-center py-5">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 30px; background: #fff;">
                        <div class="row g-0 align-items-center">
                            {{-- Image Column --}}
                            <div class="col-md-5" style="min-height: 400px; position: relative;">
                                <img src="{{ asset('storage/ceo.jpeg') }}"
                                    alt="CEO"
                                    style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
                                {{-- Overlay for a bit of style --}}
                                <div
                                    style="position: absolute; bottom: 0; left: 0; right: 0; padding: 30px; background: linear-gradient(to top, rgba(230, 57, 70, 0.8), transparent); color: #fff;">
                                    <h4 class="fw-bold mb-0">সাব্বির হাসান</h4>
                                    <p class="small mb-0 opacity-75 text-uppercase" style="letter-spacing: 1px;">প্রতিষ্ঠাতা
                                        ও সিইও</p> <small>BLOODFIGHTERS</small>
                                </div>
                            </div>

                            {{-- Text Column --}}
                            <div class="col-md-7 p-4 p-md-5">
                                <div
                                    style="width: 50px; height: 5px; background: #e63946; border-radius: 5px; margin-bottom: 20px;">
                                </div>
                                <i class="fas fa-quote-left fa-3x mb-3"
                                    style="color: #f1f1f1; position: absolute; top: 40px; right: 40px; z-index: 0;"></i>

                                <h2 class="fw-bold mb-4" style="color: #2d3436; position: relative; z-index: 1;">মানবিকতার
                                    কল্যাণে আমরা ঐক্যবদ্ধ</h2>

                                <p class="fs-5"
                                    style="color: #636e72; line-height: 1.8; text-align: justify; position: relative; z-index: 1;">
                                    "রক্তদান কেবল একটি চিকিৎসা পদ্ধতি নয়, এটি নিঃস্বার্থ ভালোবাসার এক অনন্য দৃষ্টান্ত।
                                    আমাদের লক্ষ্য একটি শক্তিশালী নেটওয়ার্ক গড়ে তোলা যেখানে জরুরি মুহূর্তে রক্তের অভাবে কোনো
                                    প্রাণ ঝরে পড়বে না। আপনার একটি সিদ্ধান্ত একটি পরিবারের মুখে হাসি ফিরিয়ে দিতে পারে।"
                                </p>

                                <div class="mt-4 d-flex align-items-center gap-3">
                                    <div
                                        style="width: 45px; height: 45px; background: #fff5f5; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-envelope text-danger"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 small text-muted">সরাসরি যোগাযোগ করুন</p>
                                        <h6 class="mb-0 fw-bold">sabbirhasan.web@gmail.com</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="row justify-content-center py-5">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg p-4 p-md-5 rounded-4" style="border-radius: 25px;">
                        <h2 class="text-center fw-bold mb-5">সাধারণ জিজ্ঞাসা (FAQ)</h2>
                        <div class="accordion accordion-flush" id="faqAccordion">
                            @foreach($faqs as $faq)
                                <div class="accordion-item mb-3"
                                    style="border: 1px solid #eee; border-radius: 12px; overflow: hidden;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fs-5 fw-bold py-3" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body fs-6" style="line-height: 1.8; color: #555;">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.counter-value');

            const startCount = (counter) => {
                const target = parseInt(counter.getAttribute('data-target'));
                let count = 0;
                const speed = 2000;
                const increment = target / (speed / 16);

                const updateCount = () => {
                    count += increment;
                    if (count < target) {
                        counter.innerText = Math.ceil(count);
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        startCount(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            counters.forEach(counter => observer.observe(counter));
        });
    </script>
@endsection