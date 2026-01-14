@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@1.6.0/Control.FullScreen.css" />
    <script src="https://unpkg.com/leaflet.fullscreen@1.6.0/Control.FullScreen.js"></script>

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
                    <a href={{url('/donors')}} class="btn btn-danger shadow-lg"
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

                            {{-- ১. ম্যাপ সেকশন (সবার উপরে) --}}
                            @if($donor->latitude && $donor->longitude)
                                <div style="height: 180px; width: 100%; background: #eee; position: relative; z-index: 1;">
                                    <div id="map-{{ $donor->id }}" 
                                        data-lat="{{ $donor->latitude }}"
                                        data-lng="{{ $donor->longitude }}"
                                        style="height: 100%; width: 100%;">
                                    </div>
                                </div>
                            @else
                                {{-- ম্যাপ না থাকলে একটি লালচে ব্যাকগ্রাউন্ড দেখাবে --}}
                                <div style="height: 120px; width: 100%; background: linear-gradient(45deg, #dc3545, #ffccd5);"></div>
                            @endif

                            <div class="card-body p-4 text-center d-flex flex-column" style="position: relative; z-index: 2;">
                                
                                {{-- ২. প্রোফাইল ইমেজ (ম্যাপের ওপর হালকা নেগেটিভ মার্জিন দিয়ে বসানো) --}}
                                <div style="position: relative; width: 120px; height: 120px; margin: -70px auto 15px;">
                                    @php
                                        $imageUrl = $donor->image ? asset('storage/' . $donor->image) : 'https://ui-avatars.com/api/?name=' . urlencode($donor->name) . '&background=f8d7da&color=dc3545&size=200';
                                    @endphp

                                    <div style="width: 100%; height: 100%; border-radius: 50%; padding: 4px; background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                        <div style="width: 100%; height: 100%; border-radius: 50%; overflow: hidden; border: 3px solid #dc3545;">
                                            <img src="{{ $imageUrl }}"
                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;"
                                                alt="{{ $donor->name }}">
                                        </div>
                                    </div>

                                    {{-- অনলাইন স্ট্যাটাস ডট --}}
                                    <span style="position: absolute; bottom: 8px; right: 8px; width: 20px; height: 20px; background: {{ $donor->is_available ? '#28a745' : '#adb5bd' }}; border: 3px solid #fff; border-radius: 50%; z-index: 3;"></span>
                                </div>

                                {{-- ৩. ব্লাড গ্রুপ ব্যাজ --}}
                                <div class="mb-3">
                                    <span style="background: rgba(220, 53, 69, 0.1); color: #dc3545; padding: 6px 16px; border-radius: 50px; font-weight: 700; font-size: 0.85rem; border: 1px solid rgba(220, 53, 69, 0.2);">
                                        <i class="fas fa-tint me-1"></i> গ্রুপ: {{ $donor->bloodGroup->name ?? 'N/A' }}
                                    </span>
                                </div>

                                <h4 class="fw-bold text-dark mb-1">{{ $donor->name }}</h4>
                                
                                <p class="small mb-3" style="font-weight: 600; color: {{ $donor->is_available ? '#28a745' : '#6c757d' }};">
                                    {{ $donor->is_available ? '● রক্তদানে ইচ্ছুক' : '● আপাতত ব্যস্ত' }}
                                </p>

                                {{-- ৪. কন্টাক্ট ইনফরমেশন বক্স --}}
                                <div style="background: #f8f9fa; border-radius: 18px; padding: 15px; text-align: left; margin-bottom: 20px; border: 1px solid #eee; flex-grow: 1;">
                                    
                                    <div style="font-size: 0.85rem; color: #555; margin-bottom: 8px; padding-bottom: 8px; border-bottom: 1px solid #e9ecef; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
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

                                {{-- ৫. লাস্ট ডোনেশন স্ট্যাটাস --}}
                                <div style="font-size: 0.8rem; font-weight: 600; color: #444; margin-bottom: 15px;">
                                    <i class="far fa-clock me-1 text-primary"></i> শেষ রক্তদান: 
                                    <span class="text-dark">{{ $donor->last_donation_date ?? 'নতুন ডোনার' }}</span>
                                </div>

                                {{-- ৬. কল বাটন --}}
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
            
           @include('frontend.count')
           @include('frontend.ceo_message')
           @include('frontend.faq')
        </div>
    </div>

    {{-- the popup blade --}}
    @include('frontend.popup')
    {{-- @include('frontend.help-for-donate') --}}
 

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

        // map
        document.addEventListener("DOMContentLoaded", function () {

            document.querySelectorAll('[id^="map-"]').forEach(function (mapDiv) {

                let lat = parseFloat(mapDiv.dataset.lat);
                let lng = parseFloat(mapDiv.dataset.lng);

                if (isNaN(lat) || isNaN(lng)) return;

                let map = L.map(mapDiv.id, {
                    zoomControl: true,
                    scrollWheelZoom: true,
                    doubleClickZoom: true,
                    touchZoom: true,
                    dragging: true,
                    attributionControl: false,
                    fullscreenControl: true,              // ✅ Enable Fullscreen
                    fullscreenControlOptions: {
                        position: 'topleft'               // button position
                    }
                }).setView([lat, lng], 14);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19
                }).addTo(map);

                L.marker([lat, lng]).addTo(map);
            });

        });


    </script>
@endsection