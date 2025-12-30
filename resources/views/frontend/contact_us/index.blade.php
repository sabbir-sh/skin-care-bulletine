@extends('frontend.layouts.app')

@section('title', 'Contact Us - Blood Fighters')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<section style="background: linear-gradient(135deg, #fff5f5, #ffe3e3); padding: 80px 0; border-bottom: 2px solid #f8d7da; text-align: center;">
    <div class="container">
        <h1 style="font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; color: #dc3545; text-transform: uppercase; margin-bottom: 15px;">
            ব্লাড ফাইটার যোগাযোগ
        </h1>
        <p style="color: #495057; max-width: 700px; margin: 0 auto; font-size: 1.15rem; line-height: 1.6;">
            জরুরি রক্তের প্রয়োজনে বা কোনো পরামর্শ থাকলে আমাদের সাথে যোগাযোগ করুন।  
            আপনার প্রতিটি বার্তা আমাদের কাছে অত্যন্ত মূল্যবান।
        </p>
    </div>
</section>

<section style="padding: 80px 0; background-color: #ffffff;">
    <div class="container">
        <div class="row g-4">

            {{-- CONTACT INFO CARD --}}
            <div class="col-lg-5">
                <div style="background: #fff; border-radius: 24px; border: 1px solid #f8d7da; padding: 40px; box-shadow: 0 15px 45px rgba(220, 53, 69, 0.08); height: 100%; transition: 0.3s;" 
                     onmouseover="this.style.borderColor='#dc3545'; this.style.transform='translateY(-5px)'" 
                     onmouseout="this.style.borderColor='#f8d7da'; this.style.transform='translateY(0)'">
                    
                    <h4 style="font-weight: 800; color: #212529; margin-bottom: 30px; border-bottom: 2px solid #dc3545; display: inline-block; padding-bottom: 5px;">
                        সরাসরি যোগাযোগ
                    </h4>
                    
                    @php
                        $contactDetails = [
                            ['icon' => 'bi-envelope-fill', 'label' => 'ইমেইল করুন', 'value' => 'sabbirhasan.web@gmail.com'],
                            ['icon' => 'bi-telephone-fill', 'label' => 'ফোন করুন', 'value' => '+880 1750-512161'],
                            ['icon' => 'bi-geo-alt-fill', 'label' => 'অবস্থান', 'value' => 'ঢাকা, বাংলাদেশ']
                        ];
                    @endphp

                    @foreach($contactDetails as $detail)
                    <div style="display: flex; align-items: center; margin-bottom: 25px;">
                        <div style="width: 50px; height: 50px; background: #dc3545; color: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-right: 20px; box-shadow: 0 4px 12px rgba(220, 53, 69, 0.25);">
                            <i class="bi {{ $detail['icon'] }}"></i>
                        </div>
                        <div>
                            <small style="color: #6c757d; display: block; font-weight: 600;">{{ $detail['label'] }}</small>
                            <span style="font-weight: 700; color: #212529; font-size: 1.05rem;">{{ $detail['value'] }}</span>
                        </div>
                    </div>
                    @endforeach

                    <hr style="margin: 30px 0; opacity: 0.1;">

                    <h6 style="font-weight: 800; margin-bottom: 20px; color: #212529;">আমাদের সোশ্যাল মিডিয়া</h6>
                    <div style="display: flex; gap: 12px;">
                        @php
                            $socials = ['facebook', 'instagram', 'youtube', 'whatsapp'];
                        @endphp
                        @foreach($socials as $social)
                        <a href="#" style="width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background: #fff5f5; color: #dc3545; border: 1px solid #f8d7da; text-decoration: none; transition: 0.3s;" 
                           onmouseover="this.style.background='#dc3545'; this.style.color='#fff'; this.style.transform='rotate(10deg)'" 
                           onmouseout="this.style.background='#fff5f5'; this.style.color='#dc3545'; this.style.transform='rotate(0deg)'">
                            <i class="bi bi-{{ $social }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- CONTACT FORM CARD --}}
            <div class="col-lg-7">
                <div style="background: #fff; border-radius: 24px; border: 1px solid #f8d7da; padding: 40px; box-shadow: 0 15px 45px rgba(220, 53, 69, 0.08);">
                    
                    @if(session('success'))
                        <div style="background: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 12px; text-align: center; font-weight: 600; margin-bottom: 25px; border: none;">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <h3 style="font-weight: 800; color: #212529; margin-bottom: 30px;">আমাদের মেসেজ পাঠান</h3>

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label style="font-weight: 700; margin-bottom: 8px; color: #495057;">আপনার নাম</label>
                                <input type="text" name="name" class="form-control" placeholder="নাম লিখুন" required 
                                       style="border-radius: 12px; padding: 12px 18px; border: 1px solid #dee2e6; transition: 0.3s;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label style="font-weight: 700; margin-bottom: 8px; color: #495057;">ইমেইল ঠিকানা</label>
                                <input type="email" name="email" class="form-control" placeholder="ইমেইল লিখুন" required 
                                       style="border-radius: 12px; padding: 12px 18px; border: 1px solid #dee2e6;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label style="font-weight: 700; margin-bottom: 8px; color: #495057;">বিষয় (Subject)</label>
                            <input type="text" name="subject" class="form-control" placeholder="কি বিষয়ে যোগাযোগ করতে চান?" 
                                   style="border-radius: 12px; padding: 12px 18px; border: 1px solid #dee2e6;">
                        </div>

                        <div class="mb-4">
                            <label style="font-weight: 700; margin-bottom: 8px; color: #495057;">আপনার বার্তা</label>
                            <textarea name="message" rows="4" class="form-control" placeholder="বিস্তারিত এখানে লিখুন..." required 
                                      style="border-radius: 12px; padding: 15px 18px; border: 1px solid #dee2e6;"></textarea>
                        </div>

                        <button type="submit" style="background-color: #dc3545; border: none; padding: 15px; border-radius: 12px; color: white; font-weight: 800; font-size: 1.1rem; width: 100%; box-shadow: 0 8px 20px rgba(220, 53, 69, 0.2); transition: 0.4s;"
                                onmouseover="this.style.backgroundColor='#bb2d3b'; this.style.transform='scale(1.02)'" 
                                onmouseout="this.style.backgroundColor='#dc3545'; this.style.transform='scale(1)'">
                            <i class="bi bi-send-fill me-2"></i> মেসেজ পাঠান
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .form-control:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1) !important;
        outline: 0;
    }
</style>
@endsection