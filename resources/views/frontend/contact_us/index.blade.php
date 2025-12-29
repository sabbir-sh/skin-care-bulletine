@extends('frontend.layouts.app')

@section('title', 'Contact Us - Blood Fighters')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<section class="contact-hero">
    <style>
        .contact-hero {
            background: linear-gradient(135deg, #fff5f5, #ffe3e3);
            padding: 80px 0;
            border-bottom: 2px solid #f8d7da;
        }
        .contact-title {
            font-size: 3rem;
            font-weight: 800;
            color: #dc3545; /* Blood Red */
            text-transform: uppercase;
        }
        .contact-subtitle {
            color: #495057;
            max-width: 700px;
            margin: 15px auto 0;
            font-size: 1.15rem;
        }
        .contact-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #f8d7da;
            box-shadow: 0 15px 45px rgba(220, 53, 69, 0.08);
            transition: all .3s ease;
        }
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(220, 53, 69, 0.12);
            border-color: #dc3545;
        }
        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #dc3545;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1);
        }
        .btn-submit {
            background-color: #dc3545;
            border: none;
            padding: 12px;
            border-radius: 10px;
            color: white;
            font-weight: 700;
            letter-spacing: 1px;
            transition: 0.3s;
        }
        .btn-submit:hover {
            background-color: #c82333;
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }
        .social-links a {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff5f5;
            color: #dc3545;
            margin-right: 10px;
            transition: .3s;
            font-size: 1.3rem;
            border: 1px solid #f8d7da;
        }
        .social-links a:hover {
            background: #dc3545;
            color: #fff;
            transform: rotate(10deg);
        }
        @media (max-width: 575px) {
            .contact-title { font-size: 2.2rem; }
        }
    </style>

    <div class="container text-center">
        <h1 class="contact-title">ব্লাড ফাইটার যোগাযোগ</h1>
        <p class="contact-subtitle">
            জরুরি রক্তের প্রয়োজনে বা কোনো পরামর্শ থাকলে আমাদের সাথে যোগাযোগ করুন।  
            আপনার প্রতিটি বার্তা আমাদের কাছে অত্যন্ত মূল্যবান।
        </p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">

            {{-- CONTACT INFO --}}
            <div class="col-lg-5">
                <div class="contact-card p-4 p-md-5 h-100">
                    <h4 class="mb-4 fw-bold">সরাসরি যোগাযোগ</h4>
                    
                    <div class="mb-4 d-flex align-items-center">
                        <span class="icon-box"><i class="bi bi-envelope-fill"></i></span>
                        <div>
                            <small class="text-muted d-block">ইমেইল করুন</small>
                            <span class="fw-bold">sabbirhasan.web@gmail.com</span>
                        </div>
                    </div>

                    <div class="mb-4 d-flex align-items-center">
                        <span class="icon-box"><i class="bi bi-telephone-fill"></i></span>
                        <div>
                            <small class="text-muted d-block">ফোন করুন</small>
                            <span class="fw-bold">+880 01750-512161</span>
                        </div>
                    </div>

                    <div class="mb-5 d-flex align-items-center">
                        <span class="icon-box"><i class="bi bi-geo-alt-fill"></i></span>
                        <div>
                            <small class="text-muted d-block">অবস্থান</small>
                            <span class="fw-bold">ঢাকা, বাংলাদেশ</span>
                        </div>
                    </div>

                    <h6 class="mb-3 fw-bold">আমাদের সোশ্যাল মিডিয়া</h6>
                    <div class="d-flex social-links">
                        <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" title="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            {{-- CONTACT FORM --}}
            <div class="col-lg-7">
                <div class="contact-card p-4 p-md-5">

                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm text-center fw-semibold mb-4">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="mb-4 fw-bold">আমাদের মেসেজ পাঠান</h3>

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">আপনার নাম</label>
                                <input type="text" name="name" class="form-control" placeholder="নাম লিখুন" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">ইমেইল ঠিকানা</label>
                                <input type="email" name="email" class="form-control" placeholder="ইমেইল লিখুন" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">বিষয় (Subject)</label>
                            <input type="text" name="subject" class="form-control" placeholder="কি বিষয়ে যোগাযোগ করতে চান?">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">আপনার বার্তা</label>
                            <textarea name="message" rows="4" class="form-control" placeholder="বিস্তারিত এখানে লিখুন..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-submit w-100 fs-5 shadow">
                            <i class="bi bi-send-fill me-2"></i> মেসেজ পাঠান
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection