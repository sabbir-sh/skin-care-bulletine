@extends('frontend.layouts.app')

@section('title', 'About Us - Blood Fighters')

@section('content')

<section style="background: linear-gradient(180deg, #ffffff 0%, #fff1f1 100%); padding: 100px 0; position: relative; overflow: hidden;">
    <i class="bi bi-droplet-fill" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 250px; color: rgba(220, 53, 69, 0.03); z-index: 0;"></i>

    <div class="container text-center" style="position: relative; z-index: 1;">
        <div style="background: #dc3545; color: white; padding: 5px 20px; border-radius: 50px; font-size: 0.9rem; font-weight: 600; display: inline-block; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);">
            Estd. 2025
        </div>
        <h1 style="font-size: clamp(2.5rem, 8vw, 3.5rem); font-weight: 900; color: #dc3545; text-transform: uppercase; letter-spacing: -1px; margin-bottom: 15px;">
            Blood <span style="color: #212529; font-weight: 800;">Fighters</span>
        </h1>
        <p style="color: #495057; max-width: 800px; margin: 0 auto; font-size: 1.15rem; line-height: 1.6;">
            আমরা কোনো সাধারণ প্ল্যাটফর্ম নই, আমরা একটি যোদ্ধাদের দল। আমাদের লক্ষ্য—রক্তের অভাবে কোনো প্রাণ যেন ঝরে না যায়। প্রতিটি রক্তদাতা আমাদের কাছে এক একজন <strong style="color: #dc3545;">"Blood Fighters"</strong>।
        </p>
    </div>
</section>

<section style="padding: 80px 0; background: #fff;">
    <div class="container">
        <div class="row g-4">
            @php
                $features = [
                    ['icon' => 'bi-rocket-takeoff-fill', 'title' => 'আমাদের মিশন', 'text' => 'জরুরি প্রয়োজনে রক্তদাতার খোঁজ পাওয়াকে সহজতম করা। একটি শক্তিশালী ডিজিটাল নেটওয়ার্ক তৈরি করা যেখানে সেকেন্ডের মধ্যে রক্তদাতার সন্ধান মিলবে।'],
                    ['icon' => 'bi-eye-fill', 'title' => 'আমাদের ভিশন', 'text' => 'বাংলাদেশের প্রতিটি জেলা ও উপজেলায় রক্তদাতাদের একটি দক্ষ ডাটাবেজ তৈরি করা, যাতে কোনো মুমূর্ষু রোগীকে রক্তের জন্য অপেক্ষা করতে না হয়।'],
                    ['icon' => 'bi-shield-shaded', 'title' => 'কেন আমরা লড়ি?', 'text' => 'প্রতিদিন হাজারো মানুষ সঠিক সময়ে রক্ত না পেয়ে সংকটে পড়ে। আমরা সেই সংকটের বিরুদ্ধে লড়াই করছি তথ্যের শক্তি এবং মানবিকতা দিয়ে।']
                ];
            @endphp

            @foreach($features as $feature)
            <div class="col-lg-4 col-md-6">
                <div class="about-card" style="background: #fff; border: 1px solid #f8d7da; border-radius: 24px; padding: 40px; box-shadow: 0 15px 35px rgba(220, 53, 69, 0.05); height: 100%; transition: 0.3s;" onmouseover="this.style.transform='translateY(-10px)'; this.style.borderColor='#dc3545'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f8d7da'">
                    <div style="font-size: 35px; color: #fff; margin-bottom: 25px; background: #dc3545; width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 18px; box-shadow: 0 10px 20px rgba(220, 53, 69, 0.2);">
                        <i class="bi {{ $feature['icon'] }}"></i>
                    </div>
                    <h4 style="font-weight: 700; color: #212529; margin-bottom: 15px;">{{ $feature['title'] }}</h4>
                    <p style="color: #6c757d; line-height: 1.6; margin-bottom: 0;">{{ $feature['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section style="padding: 80px 0; background-color: #fcfcfc; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 style="font-weight: 800; color: #dc3545; margin-bottom: 25px; font-size: 2.2rem;">রক্ত দিয়ে বাঁচান একটি অমূল্য প্রাণ</h2>
                <p style="font-size: 1.1rem; color: #444; margin-bottom: 30px;">একজন ব্লাড ফাইটার হিসেবে আপনি যা পাবেন:</p>
                
                @php
                    $benefits = ['মানুষের জীবন বাঁচানোর আত্মতৃপ্তি।', 'নিজের স্বাস্থ্যের নিয়মিত আপডেট।', 'একটি বৃহৎ মানবিক কমিউনিটির সদস্য হওয়া।', 'পরিবারের জন্য দ্রুত সাহায্য পাওয়ার নিশ্চয়তা।'];
                @endphp

                <div class="list-group list-group-flush shadow-sm rounded-4 overflow-hidden">
                    @foreach($benefits as $benefit)
                    <div class="list-group-item" style="padding: 15px 20px; border-left: 4px solid #dc3545; background: #fff;">
                        <i class="bi bi-check2-circle text-danger me-3 fs-5"></i> <span style="font-weight: 500;">{{ $benefit }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div style="width: 280px; height: 280px; background: #fff; border-radius: 50%; display: inline-flex; flex-direction: column; justify-content: center; align-items: center; border: 8px solid #dc3545; box-shadow: 0 20px 50px rgba(220, 53, 69, 0.15); position: relative;">
                    <div style="position: absolute; width: 100%; height: 100%; border: 2px solid #dc3545; border-radius: 50%; opacity: 0.3; animation: pulse 2s infinite;"></div>
                    
                    <h1 style="font-size: 4rem; font-weight: 900; color: #dc3545; margin-bottom: 0; line-height: 1;">
                        {{ number_format($totalDonors ?? 0) }}
                    </h1>
                    <p style="font-weight: 800; color: #212529; margin: 5px 0 0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Registered Fighters</p>
                    <small style="color: #6c757d; font-style: italic;">Saving Lives Together</small>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0; background: #fff; text-align: center;">
    <div class="container">
        <h2 style="font-weight: 800; margin-bottom: 40px; color: #212529;">আপনি কি আমাদের পরবর্তী ফাইটার?</h2>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="{{ url('/be-a-fighter-register') }}" style="background: #dc3545; color: #fff; text-decoration: none; padding: 18px 45px; border-radius: 50px; font-weight: 700; font-size: 1.1rem; box-shadow: 0 10px 25px rgba(220, 53, 69, 0.3); transition: 0.3s;" onmouseover="this.style.transform='scale(1.05)'; this.style.backgroundColor='#bb2d3b'" onmouseout="this.style.transform='scale(1)'; this.style.backgroundColor='#dc3545'">
                <i class="bi bi-droplet-fill me-2"></i>রেজিস্ট্রেশন করুন
            </a>
            <a href="{{ url('/#donors') }}" style="background: transparent; color: #212529; text-decoration: none; padding: 18px 45px; border-radius: 50px; font-weight: 700; font-size: 1.1rem; border: 2px solid #212529; transition: 0.3s;" onmouseover="this.style.backgroundColor='#212529'; this.style.color='#fff'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#212529'">
                জরুরি রক্ত প্রয়োজন?
            </a>
        </div>
    </div>
</section>

<style>
    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.5; }
        100% { transform: scale(1.3); opacity: 0; }
    }
</style>

@endsection