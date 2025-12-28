@extends('frontend.layouts.app')

@section('title', 'About Us - Blood Fighter')

@section('content')

<section class="about-hero">
    <style>
        .about-hero {
            /* ব্লাড ফাইটার থিমের জন্য পিওর হোয়াইট ও রেড গ্রেডিয়েন্ট */
            background: linear-gradient(180deg, #fff 0%, #fff1f1 100%);
            padding: 100px 0;
            position: relative;
        }
        
        .hero-icon-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 250px;
            color: rgba(220, 53, 69, 0.03);
            z-index: 0;
        }

        .about-title {
            font-size: 3.5rem;
            font-weight: 900;
            color: #dc3545;
            text-transform: uppercase;
            letter-spacing: -1px;
        }
        
        .brand-name {
            color: #212529;
            font-weight: 800;
        }

        .about-subtitle {
            color: #495057;
            max-width: 800px;
            margin: 20px auto 0;
            font-size: 1.2rem;
            position: relative;
            z-index: 1;
        }

        .about-card {
            background: #fff;
            border: 1px solid #f8d7da;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(220, 53, 69, 0.06);
            height: 100%;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .about-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 60px rgba(220, 53, 69, 0.12);
            border-color: #dc3545;
        }

        .about-icon {
            font-size: 40px;
            color: #fff;
            margin-bottom: 25px;
            background: #dc3545;
            width: 75px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.2);
        }

        .fighter-badge {
            background: #dc3545;
            color: white;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }

        /* 📱 Mobile Styling */
        @media (max-width: 767px) {
            .about-title {
                font-size: 2.5rem;
            }
            .about-hero {
                padding: 70px 0;
            }
        }
    </style>

    <i class="bi bi-droplet-fill hero-icon-bg"></i>

    <div class="container text-center">
        <div class="fighter-badge">Estd. 2025</div>
        <h1 class="about-title">Blood <span class="brand-name">Fighter</span></h1>
        <p class="about-subtitle">
            আমরা কোনো সাধারণ প্ল্যাটফর্ম নই, আমরা একটি যোদ্ধাদের দল। আমাদের লক্ষ্য—রক্তের অভাবে কোনো প্রাণ যেন ঝরে না যায়। প্রতিটি রক্তদাতা আমাদের কাছে এক একজন <strong>"Blood Fighter"</strong>।
        </p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">

            {{-- The Mission --}}
            <div class="col-lg-4 col-md-6">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-rocket-takeoff-fill"></i>
                    </div>
                    <h4>আমাদের মিশন</h4>
                    <p class="text-muted">
                        জরুরি প্রয়োজনে রক্তদাতার খোঁজ পাওয়াকে সহজতম করা। একটি শক্তিশালী ডিজিটাল নেটওয়ার্ক তৈরি করা যেখানে সেকেন্ডের মধ্যে রক্তদাতার সন্ধান মিলবে।
                    </p>
                </div>
            </div>

            {{-- The Vision --}}
            <div class="col-lg-4 col-md-6">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <h4>আমাদের ভিশন</h4>
                    <p class="text-muted">
                        বাংলাদেশের প্রতিটি জেলা ও উপজেলায় রক্তদাতাদের একটি দক্ষ ডাটাবেজ তৈরি করা, যাতে কোনো মুমূর্ষু রোগীকে রক্তের জন্য অপেক্ষা করতে না হয়।
                    </p>
                </div>
            </div>

            {{-- Why We Fight --}}
            <div class="col-lg-4 col-md-12">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-shield-shaded"></i>
                    </div>
                    <h4>কেন আমরা লড়ি?</h4>
                    <p class="text-muted">
                        প্রতিদিন হাজারো মানুষ সঠিক সময়ে রক্ত না পেয়ে সংকটে পড়ে। আমরা সেই সংকটের বিরুদ্ধে লড়াই করছি তথ্যের শক্তি এবং মানবিকতা দিয়ে।
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Impact Section --}}
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="fw-bold text-danger mb-4">রক্ত দিয়ে বাঁচান একটি অমূল্য প্রাণ</h2>
                <p class="lead text-dark">একজন ব্লাড ফাইটার হিসেবে আপনি যা পাবেন:</p>
                <ul class="list-unstyled">
                    <li class="mb-3"><i class="bi bi-check2-circle text-danger me-2 fs-5"></i> মানুষের জীবন বাঁচানোর আত্মতৃপ্তি।</li>
                    <li class="mb-3"><i class="bi bi-check2-circle text-danger me-2 fs-5"></i> নিজের স্বাস্থ্যের নিয়মিত আপডেট (রক্তদানের মাধ্যমে)।</li>
                    <li class="mb-3"><i class="bi bi-check2-circle text-danger me-2 fs-5"></i> একটি বৃহৎ মানবিক কমিউনিটির সদস্য হওয়া।</li>
                    <li class="mb-3"><i class="bi bi-check2-circle text-danger me-2 fs-5"></i> জরুরি অবস্থায় নিজের পরিবারের জন্য দ্রুত সাহায্য পাওয়ার নিশ্চয়তা।</li>
                </ul>
            </div>
            <div class="col-md-6 text-center">
    <div class="p-5 bg-white rounded-circle shadow-lg d-inline-block border border-danger border-5" style="width: 280px; height: 280px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        
        <h1 class="display-3 fw-bold text-danger mb-0">
            {{ number_format($totalDonors ?? 0) }}
        </h1>
        
        <p class="fw-bold text-uppercase mb-0">Registered Fighters</p>
        <small class="text-muted">Saving Lives Together</small>
        
    </div>
</div>
        </div>
    </div>
</section>

<section class="py-5 text-center">
    <div class="container">
        <h2 class="fw-bold mb-4">আপনি কি আমাদের পরবর্তী ফাইটার?</h2>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ url('/') }}" class="btn btn-danger btn-lg px-5 py-3 shadow-lg rounded-pill fw-bold">
                <i class="bi bi-droplet-fill me-2"></i>রেজিস্ট্রেশন করুন
            </a>
            <a href="{{ url('/') }}" class="btn btn-outline-dark btn-lg px-5 py-3 rounded-pill fw-bold">
                জরুরি রক্ত প্রয়োজন?
            </a>
        </div>
    </div>
</section>

@endsection