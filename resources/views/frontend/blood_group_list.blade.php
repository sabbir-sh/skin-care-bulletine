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

                    <div
                        style="background:#fff;border-radius:25px;margin-top:40px;transition:.4s;box-shadow:0 5px 15px rgba(0,0,0,.08);height:100%;">
                        <div style="padding:30px;text-align:center;">

                            {{-- Image --}}
                            <div style="margin-top:-70px;position:relative;">
                                <img src="{{ $donor->image ? asset('storage/' . $donor->image) : 'https://ui-avatars.com/api/?name=' . urlencode($donor->name) . '&background=E63946&color=fff' }}"
                                    style="width:110px;height:110px;border-radius:50%;border:5px solid #fff;object-fit:cover;box-shadow:0 5px 15px rgba(0,0,0,.15);">

                                <span style="position:absolute;bottom:5px;left:60%;width:16px;height:16px;border-radius:50%;border:3px solid #fff;
                                        background:{{ $donor->is_available ? '#28a745' : '#6c757d' }};">
                                </span>
                            </div>

                            {{-- Name --}}
                            <h3 style="margin-top:20px;font-weight:700;">
                                {{ $donor->name }}
                            </h3>

                            {{-- Blood Group --}}
                            <div
                                style="background:#e63946;color:#fff;padding:6px 18px;border-radius:30px;display:inline-block;font-weight:600;margin-bottom:20px;">
                                রক্তের গ্রুপ: {{ $donor->bloodGroup->name ?? 'N/A' }}
                            </div>

                            {{-- Info --}}
                            <div
                                style="background:#fff5f5;border-radius:15px;padding:15px;text-align:left;margin-bottom:15px;font-size:14px;">

                                <div style="margin-bottom:6px;">
                                    📧 {{ $donor->email }}
                                </div>

                                <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
                                    <span>👤 {{ ucfirst($donor->gender) }}</span>
                                    <span>
                                        🎂
                                        {{ $donor->date_of_birth ? \Carbon\Carbon::parse($donor->date_of_birth)->age : '??' }}
                                        বছর
                                    </span>
                                </div>

                                <div style="border-top:1px solid #ddd;padding-top:8px;">
                                    📍
                                    {{ $donor->village ?? '' }},
                                    {{ $donor->union ?? '' }},
                                    {{ $donor->upazila }},
                                    {{ $donor->district }}
                                </div>
                            </div>

                            {{-- Last Donation --}}
                            <div style="padding:6px;border-radius:6px;font-size:13px;font-weight:600;
                                    background:{{ $donor->is_available ? '#d4edda' : '#fff3cd' }};
                                    color:{{ $donor->is_available ? '#155724' : '#856404' }};">
                                শেষ দান: {{ $donor->last_donation_date ?? 'তথ্য নেই' }}
                            </div>

                            {{-- Call Button --}}
                            <a href="tel:{{ $donor->phone }}"
                                style="margin-top:18px;display:block;background:#e63946;color:#fff;padding:12px;border-radius:30px;font-weight:700;text-decoration:none;">
                                📞 এখনই কল দিন
                            </a>

                        </div>
                    </div>

                </div>
            @empty
                <div class="col-12 text-center">
                    <h3>কোনো ডাটা পাওয়া যায়নি</h3>
                </div>
            @endforelse

        </div>
    </div>

@endsection