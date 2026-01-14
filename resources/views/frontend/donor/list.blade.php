@extends('frontend.layouts.app')

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@1.6.0/Control.FullScreen.css" />
<script src="https://unpkg.com/leaflet.fullscreen@1.6.0/Control.FullScreen.js"></script>

@section('content')
<div style="background: #f8f9fa; padding: 20px 0;">
    {{-- সার্চ সেকশন --}}
    <div class="container mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; background: #ffffff;">
            <div class="card-body p-3 p-lg-4">
                <form action="{{ route('frontend.home') }}" method="GET">
                    <div class="row g-2">
                        <div class="col-6 col-lg-3">
                            <input type="text" name="district" value="{{ request('district') }}" class="form-control border-0 bg-light shadow-none" placeholder="জেলা" style="border-radius: 12px; height: 45px; font-size: 14px;">
                        </div>
                        <div class="col-6 col-lg-3">
                            <input type="text" name="upazila" value="{{ request('upazila') }}" class="form-control border-0 bg-light shadow-none" placeholder="উপজেলা" style="border-radius: 12px; height: 45px; font-size: 14px;">
                        </div>
                        <div class="col-6 col-lg-2">
                            <input type="text" name="union" value="{{ request('union') }}" class="form-control border-0 bg-light shadow-none" placeholder="ইউনিয়ন" style="border-radius: 12px; height: 45px; font-size: 14px;">
                        </div>
                        <div class="col-6 col-lg-2">
                            <input type="text" name="village" value="{{ request('village') }}" class="form-control border-0 bg-light shadow-none" placeholder="গ্রাম" style="border-radius: 12px; height: 45px; font-size: 14px;">
                        </div>
                        <div class="col-12 col-lg-2">
                            <button type="submit" class="btn btn-danger w-100 fw-bold shadow-sm" style="border-radius: 12px; height: 45px; background: linear-gradient(45deg, #dc3545, #ff4d5a); border: none;">
                                <i class="fas fa-search"></i> খুঁজুন
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- কার্ড সেকশন --}}
    <div class="container">
        <div class="row g-2 g-md-3">
            @forelse($recentDonors as $donor)
                <div class="col-6 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden; background: #ffffff; transition: all 0.3s ease;" 
                        onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 15px 35px rgba(220,53,69,0.15)';" 
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.05)';">

                        {{-- ম্যাপ --}}
                        <div style="height: 120px; width: 100%; background: #f0f0f0; position: relative;">
                            @if($donor->latitude && $donor->longitude)
                                <div id="map-{{ $donor->id }}" 
                                    data-lat="{{ $donor->latitude }}"
                                    data-lng="{{ $donor->longitude }}"
                                    style="height: 100%; width: 100%;">
                                </div>
                            @else
                                <div style="height: 100%; width: 100%; background: linear-gradient(135deg, #ffcdd2, #ef9a9a); display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-map-marker-alt text-white" style="font-size: 30px; opacity:0.5;"></i>
                                </div>
                            @endif
                        </div>

                        <div class="card-body p-2 p-md-3 text-center d-flex flex-column" style="position: relative;">
                            {{-- প্রোফাইল ইমেজ ভেসে থাকবে --}}
                            <div style="position: absolute; top: -35px; left: 50%; transform: translateX(-50%); width: 70px; height: 70px; z-index: 10;">

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

                                {{-- Availability Status --}}
                                <span style="
                                    position: absolute;
                                    bottom: 2px;
                                    right: 2px;
                                    width: 12px;
                                    height: 12px;
                                    background: {{ $donor->is_available ? '#28a745' : '#adb5bd' }};
                                    border: 2px solid #fff;
                                    border-radius: 50%;
                                "></span>

                            </div>


                            {{-- নাম, ব্লাড গ্রুপ ও লোকেশন overlay --}}
                            <div style="margin-top: 40px;">
                                <div style="margin-bottom: 5px;">
                                    <span style="background: #fff5f5; color: #dc3545; padding: 2px 8px; border-radius: 50px; font-weight: 800; font-size: 12px; border: 1px solid #ffebeb;">
                                        {{ $donor->bloodGroup->name ?? 'N/A' }}
                                    </span>
                                </div>

                                <h6 style="font-weight: 700; color: #333; margin-bottom: 2px; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $donor->name }}</h6>
                                <p style="font-size: 11px; color: #6c757d; margin-bottom: 10px;">
                                    <i class="fas fa-map-marker-alt text-danger"></i> {{ $donor->upazila }}
                                </p>

                                {{-- কন্টাক্ট ইনফো --}}
                                <div style="background: #fdf2f2; border-radius: 10px; padding: 8px; font-size: 11px; text-align: left; margin-bottom: 12px; flex-grow: 1;">
                                    <div style="margin-bottom: 3px; color: #444;">
                                        <i class="far fa-clock text-danger me-1"></i> শেষ রক্তদান: <span style="font-weight: 600;">{{ $donor->last_donation_date ?? 'নতুন' }}</span>
                                    </div>
                                    <div style="color: #444;">
                                        <i class="fas fa-history text-danger me-1"></i> মোট: <span style="font-weight: 600;">{{ $donor->total_donations ?? '0' }} বার</span>
                                    </div>
                                </div>

                                {{-- কল বাটন --}}
                                <div class="mt-auto">
                                    <a href="tel:{{ $donor->phone }}" class="btn btn-danger w-100 py-2 fw-bold" style="border-radius: 10px; background: #dc3545; border: none; font-size: 13px;">
                                        <i class="fas fa-phone-alt"></i> কল দিন
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">দাতা পাওয়া যায়নি।</h5>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('[id^="map-"]').forEach(function (mapDiv) {
        let lat = parseFloat(mapDiv.dataset.lat);
        let lng = parseFloat(mapDiv.dataset.lng);
        if (isNaN(lat) || isNaN(lng)) return;

        let map = L.map(mapDiv.id, {
            zoomControl: false,
            scrollWheelZoom: false,
            dragging: true,
            attributionControl: false
        }).setView([lat, lng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.marker([lat, lng]).addTo(map);
    });
});
</script>
@endsection
