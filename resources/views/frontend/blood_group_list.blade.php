@extends('frontend.layouts.app')

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@1.6.0/Control.FullScreen.css" />
<script src="https://unpkg.com/leaflet.fullscreen@1.6.0/Control.FullScreen.js"></script>

@section('content')

{{-- HEADER --}}
<section style="background:linear-gradient(135deg,#e63946,#c1121f);padding:60px 0;color:#fff;margin-bottom:40px;border-radius:0 0 50px 50px;text-align:center;">
    <div class="container">
        <h1 style="font-size:42px;font-weight:800;">
            {{ $selectedGroup->name }} গ্রুপের রক্তদাতা
        </h1>
        <p style="opacity:.9;font-size:18px;">
            বর্তমানে এই গ্রুপে মোট {{ $totalDonors }} জন দাতা পাওয়া গেছে
        </p>
    </div>
</section>

<div class="container">
    <div class="row g-4">

        {{-- LEFT: DONOR CARDS --}}
        <div class="col-lg-9">
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
                                    $hasImage = !empty($donor->image);

                                    // নামের প্রথম word
                                    $firstWord = trim(explode(' ', $donor->name)[0]);

                                    // প্রথম 2টা অক্ষর (Bangla/English safe)
                                    $initials = mb_substr($firstWord, 0, 2);
                                @endphp

                                <div style="
                                    width: 100%;
                                    height: 100%;
                                    border-radius: 50%;
                                    padding: 3px;
                                    background: #fff;
                                    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                ">

                                    @if($hasImage)
                                        <img src="{{ asset('storage/'.$donor->image) }}"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 2px solid #dc3545;"
                                            alt="{{ $donor->name }}">
                                    @else
                                        <div style="
                                            width: 100%;
                                            height: 100%;
                                            border-radius: 50%;
                                            background: #f8d7da;
                                            color: #dc3545;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            font-weight: 700;
                                            font-size: 22px;
                                            border: 2px solid #dc3545;
                                            text-transform: uppercase;
                                        ">
                                            {{ $initials }}
                                        </div>
                                    @endif
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
        </div>

        {{-- RIGHT: SIDEBAR --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm"
                 style="border-radius:20px;position:sticky;top:90px;">
                <div class="card-body">
                    <h5 style="font-weight:800;color:#dc3545;margin-bottom:16px;">
                        <i class="fas fa-tint"></i> সক্রিয় ব্লাড গ্রুপ
                    </h5>

                    @foreach($bloodGroups as $group)
                        <a href="{{ route('blood.group',$group->slug) }}"
                           style="
                           display:flex;
                           justify-content:space-between;
                           align-items:center;
                           padding:10px 14px;
                           border-radius:12px;
                           margin-bottom:8px;
                           font-weight:700;
                           text-decoration:none;
                           background:{{ $activeGroup==$group->slug?'#dc3545':'#f8f9fa' }};
                           color:{{ $activeGroup==$group->slug?'#fff':'#333' }};
                           ">
                            <span>{{ $group->name }}</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

{{-- MAP SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('[id^="map-"]').forEach(function (mapDiv) {
        let lat = parseFloat(mapDiv.dataset.lat);
        let lng = parseFloat(mapDiv.dataset.lng);
        if (isNaN(lat) || isNaN(lng)) return;

        let map = L.map(mapDiv.id, {
            scrollWheelZoom:true,
            fullscreenControl:true,
            attributionControl:false
        }).setView([lat, lng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19}).addTo(map);
        L.marker([lat,lng]).addTo(map);
    });
});
</script>

@endsection
