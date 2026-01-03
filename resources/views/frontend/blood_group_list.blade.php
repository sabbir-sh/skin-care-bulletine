@extends('frontend.layouts.app')

@section('content')

    <section
        style="background:linear-gradient(135deg,#e63946,#c1121f);padding:60px 0;color:#fff;margin-bottom:50px;border-radius:0 0 50px 50px;text-align:center;">
        <div class="container">
            <h1 style="font-size:42px;font-weight:700;">
                {{ $selectedGroup->name }} গ্রুপের রক্তদাতা
            </h1>
            <p style="opacity:.85;font-size:18px;">
                বর্তমানে এই গ্রুপে মোট {{ $totalDonors }} জন দাতা পাওয়া গেছে
            </p>
        </div>
    </section>

    <div class="container pb-5">
        <div class="row g-4">
            @forelse($recentDonors as $donor)
                <div class="col-lg-4 col-md-6">
                    <div style="background:#fff; border-radius:30px; margin-top:50px; transition:.4s ease; box-shadow:0 10px 30px rgba(0,0,0,.05); height:100%; border: 1px solid #f0f0f0;">
                        <div style="padding:30px; text-align:center;">

                            {{-- প্রোফাইল ইমেজ ও অনলাইন স্ট্যাটাস --}}
                            <div style="margin-top:-80px; position:relative; display: inline-block;">
                                <img src="{{ $donor->image ? asset('storage/' . $donor->image) : 'https://ui-avatars.com/api/?name=' . urlencode($donor->name) . '&background=E63946&color=fff' }}"
                                    style="width:120px; height:120px; border-radius:50%; border:6px solid #fff; object-fit:cover; box-shadow:0 8px 20px rgba(0,0,0,.12);">
                                
                                <span title="{{ $donor->is_available ? 'রক্তদানে প্রস্তুত' : 'এখন ব্যস্ত' }}"
                                    style="position:absolute; bottom:10px; right:10px; width:20px; height:20px; border-radius:50%; border:3px solid #fff;
                                    background:{{ $donor->is_available ? '#28a745' : '#6c757d' }}; shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                </span>
                            </div>

                            {{-- নাম ও রক্তের গ্রুপ --}}
                            <h4 style="margin-top:15px; font-weight:800; color:#2d3436; margin-bottom: 5px;">
                                {{ $donor->name }}
                            </h4>

                            <div style="background:rgba(230, 57, 70, 0.1); color:#e63946; padding:5px 15px; border-radius:30px; display:inline-block; font-weight:700; font-size:14px; margin-bottom:20px; border: 1px solid rgba(230, 57, 70, 0.2);">
                                <i class="fas fa-tint me-1"></i> গ্রুপ: {{ $donor->bloodGroup->name ?? 'N/A' }}
                            </div>

                            {{-- ইনফরমেশন বক্স --}}
                            <div style="background:#fafafa; border-radius:20px; padding:20px; text-align:left; margin-bottom:20px; font-size:14px; color: #636e72;">
                                
                                {{-- Email (Optional Logic) --}}
                                <div style="margin-bottom:10px; display: flex; align-items: center;">
                                    <span style="margin-right:10px;">📧</span>
                                    <span style="word-break: break-all;">{{ $donor->email ?? 'N/A' }}</span>
                                </div>

                                <div style="display:flex; justify-content:space-between; margin-bottom:10px; padding-bottom: 10px; border-bottom: 1px dashed #dfe6e9;">
                                    <span>👤 {{ ucfirst($donor->gender) }}</span>
                                    <span>🎂 {{ $donor->date_of_birth ? \Carbon\Carbon::parse($donor->date_of_birth)->age : '??' }} বছর</span>
                                </div>

                                {{-- Address with Clean Comma Management --}}
                                <div style="line-height: 1.6; display: flex;">
                                    <span style="margin-right:10px;">📍</span>
                                    <span>
                                        @php
                                            $address = array_filter([$donor->village, $donor->union, $donor->upazila, $donor->district]);
                                            echo implode(', ', $address);
                                        @endphp
                                    </span>
                                </div>
                            </div>

                            {{-- লাস্ট ডোনেশন স্ট্যাটাস --}}
                            <div style="padding:10px; border-radius:12px; font-size:13px; font-weight:700;
                                        background:{{ $donor->is_available ? '#f0fff4' : '#fffaf0' }};
                                        color:{{ $donor->is_available ? '#2f855a' : '#c05621' }}; border: 1px solid {{ $donor->is_available ? '#c6f6d5' : '#feebc8' }};">
                                <i class="far fa-calendar-check me-1"></i> 
                                শেষ দান: {{ $donor->last_donation_date ?? 'নতুন যোদ্ধা' }}
                            </div>

                            {{-- কল বাটন --}}
                            <a href="tel:{{ $donor->phone }}"
                            style="margin-top:20px; display:block; background:linear-gradient(45deg, #e63946, #d62828); color:#fff; padding:14px; border-radius:15px; font-weight:700; text-decoration:none; box-shadow: 0 4px 15px rgba(230, 57, 70, 0.3); transition: .3s;">
                                <i class="fas fa-phone-alt me-2"></i> এখনই কল দিন
                            </a>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" style="width: 100px; opacity: 0.2;" class="mb-3">
                    <h4 style="color: #b2bec3;">দুঃখিত, কোনো ডোনার পাওয়া যায়নি</h4>
                </div>
            @endforelse
        </div>
    </div>

@endsection