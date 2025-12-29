@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="main-wrapper" style="font-family: 'Hind Siliguri', sans-serif; background-color: #f8f9fa;">

        <section class="hero-section text-center" style="background: linear-gradient(135deg, #fff0f0 0%, #ffcccc 100%); padding: 100px 0; position: relative; overflow: hidden;">
            <div class="container">
                <h1 class="animate__animated animate__fadeInDown" style="font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 800; color: #e63946; text-shadow: 5px 5px 15px rgba(230, 57, 70, 0.3); line-height: 1.2;">
                    <span style="display: inline-block; animation: floating 3s ease-in-out infinite;">রক্তদানই</span> <br>
                    <span style="color: #212529;">জীবনের সেরা উপহার</span>
                </h1>
                <p class="fs-4 text-muted mt-4 animate__animated animate__fadeInUp animate__delay-1s px-md-5">
                    আপনার এক ব্যাগ রক্তে বেঁচে যেতে পারে একটি হাসি। আপনিও হতে পারেন একজন জীবন রক্ষাকারী নায়ক।
                </p>
                <div class="mt-5 animate__animated animate__zoomIn animate__delay-2s">
                    <a href="#donors" class="btn btn-danger shadow-lg" style="padding: 15px 40px; font-size: 1.2rem; font-weight: 700; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px;">
                        রক্তদাতার তালিকা দেখুন
                    </a>
                </div>
            </div>
            
            <style>
                @keyframes floating {
                    0%, 100% { transform: translateY(0px); }
                    50% { transform: translateY(-20px); }
                }
            </style>
        </section>

        <div class="container py-5 mt-5" id="donors">
            
<div class="text-center mb-5">
    <h2 class="display-5 fw-bold text-dark">আমাদের বীর রক্তদাতারা</h2>
    <div style="background: linear-gradient(90deg, transparent, #dc3545, transparent); margin: 10px auto; width: 120px; height: 5px; border-radius: 5px;"></div>
</div>

<div class="row g-4">
    @foreach($recentDonors as $donor)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100" style="border: none; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.4s ease; overflow: hidden; background: #ffffff;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 35px rgba(220, 53, 69, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.08)'">
                
                <div class="card-body p-4 text-center d-flex flex-column">
                    
                    <div style="position: relative; width: 110px; height: 110px; margin: 0 auto 20px;">
                        <img src="{{ $donor->image ? asset('storage/donor-image/' . $donor->image) : 'https://ui-avatars.com/api/?name=' . urlencode($donor->name) . '&background=f8d7da&color=dc3545&size=128' }}" 
                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);" 
                             alt="{{ $donor->name }}">
                        
                        <span style="position: absolute; bottom: 8px; right: 8px; width: 18px; height: 18px; background: {{ $donor->is_available ? '#198754' : '#6c757d' }}; border: 3px solid #fff; border-radius: 50%; shadow: 0 2px 5px rgba(0,0,0,0.2);"></span>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <span style="background: #dc3545; color: white; padding: 6px 18px; border-radius: 50px; font-weight: bold; font-size: 0.85rem; box-shadow: 0 4px 10px rgba(220, 53, 69, 0.25);">
                            রক্তের গ্রুপ: {{ $donor->bloodGroup->name ?? 'N/A' }}
                        </span>
                    </div>

                    <h3 class="fw-bold text-dark mb-1" style="font-size: 1.4rem;">{{ $donor->name }}</h3>
                    
                    <div class="mb-3" style="font-size: 0.85rem; font-weight: 600; color: {{ $donor->is_available ? '#198754' : '#6c757d' }};">
                        {{ $donor->is_available ? 'রক্তদানে প্রস্তুত' : 'এখন ব্যস্ত' }}
                    </div>

                    <div style="background: #fdfdfd; border-radius: 15px; padding: 15px; text-align: left; margin-bottom: 15px; border: 1px solid #f1f1f1; flex-grow: 1;">
                        <div style="margin-bottom: 8px; font-size: 0.85rem; border-bottom: 1px solid #f8f9fa; padding-bottom: 5px; color: #555;">
                            <i class="fas fa-envelope text-danger me-2"></i> {{ $donor->email }}
                        </div>
                        
                        <div class="row g-0 mb-2" style="font-size: 0.85rem; color: #555;">
                            <div class="col-6">
                                <i class="fas fa-venus-mars text-danger me-2"></i> {{ ucfirst($donor->gender) }}
                            </div>
                            <div class="col-6 text-end">
                                <i class="fas fa-birthday-cake text-danger me-1"></i> {{ $donor->date_of_birth ? \Carbon\Carbon::parse($donor->date_of_birth)->age : '??' }} বছর
                            </div>
                        </div>

                        <div style="font-size: 0.8rem; line-height: 1.5; color: #666; display: flex;">
                            <i class="fas fa-map-marker-alt text-danger me-2" style="width: 15px; margin-top: 3px;"></i>
                            <span>{{ $donor->village }}, {{ $donor->union }}, {{ $donor->upazila }}, {{ $donor->district }}</span>
                        </div>
                    </div>

                    <div style="background: {{ $donor->is_available ? '#e8f5e9' : '#fff3e0' }}; color: {{ $donor->is_available ? '#1b5e20' : '#e65100' }}; border-radius: 12px; padding: 10px; font-size: 0.85rem; font-weight: bold; margin-bottom: 15px; border: 1px solid rgba(0,0,0,0.03);">
                        <i class="far fa-calendar-check me-1"></i> শেষ দান: {{ $donor->last_donation_date ?? 'তথ্য নেই' }}
                    </div>

                    <div class="mt-auto">
                        <a href="tel:{{ $donor->phone }}" class="btn btn-danger btn-lg w-100 rounded-pill" style="background: #dc3545; border: none; font-weight: bold; padding: 12px; transition: 0.3s; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);">
                            <i class="fas fa-phone-alt me-2"></i> এখনই কল দিন
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
                            <span class="badge bg-danger px-3 py-2 fs-6 rounded-pill">{{ $selectedGroup->name }}</span> গ্রুপের দাতারা দেখানো হচ্ছে
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
                                <span style="font-size: 1.8rem; font-weight: 800; color: {{ $isActive ? 'white' : '#e63946' }}; display: block;">{{ $bg->name }}</span>
                                <span style="font-size: 0.85rem; color: {{ $isActive ? 'white' : '#666' }}; font-weight: 600; background: {{ $isActive ? 'rgba(255,255,255,0.2)' : '#f8f9fa' }}; padding: 2px 10px; border-radius: 50px; display: inline-block;">
                                    দাতা: {{ $bg->donors_count }} জন
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="row justify-content-center py-5">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg p-4 p-md-5 rounded-4" style="border-radius: 25px;">
                        <h2 class="text-center fw-bold mb-5">সাধারণ জিজ্ঞাসা (FAQ)</h2>
                        <div class="accordion accordion-flush" id="faqAccordion">
                            @foreach($faqs as $faq)
                                <div class="accordion-item mb-3" style="border: 1px solid #eee; border-radius: 12px; overflow: hidden;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fs-5 fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
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
@endsection