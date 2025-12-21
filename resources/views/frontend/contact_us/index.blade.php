@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<section class="contact-hero">
    <style>
        .contact-hero {
            background: linear-gradient(135deg, #f8f9fa, #eef1f5);
            padding: 80px 0;
        }
        .contact-title {
            font-size: 2.8rem;
            font-weight: 800;
        }
        .contact-subtitle {
            color: #6c757d;
            max-width: 700px;
            margin: 15px auto 0;
            font-size: 1.1rem;
        }
        .contact-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0,0,0,.08);
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .contact-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 50px rgba(0,0,0,.1);
        }
        .icon-box {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #0d6efd;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
        .social-links a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f1f3f5;
            color: #333;
            margin-right: 10px;
            transition: .3s;
            font-size: 1.1rem;
        }
        .social-links a:hover {
            background: #0d6efd;
            color: #fff;
        }
        @media (max-width: 575px) {
            .contact-title {
                font-size: 2rem;
            }
            .contact-subtitle {
                font-size: 1rem;
            }
        }
    </style>

    <div class="container text-center">
        <h1 class="contact-title">Get in Touch</h1>
        <p class="contact-subtitle lead">
            Have a question, suggestion, or feedback?  
            We’d love to hear from you.
        </p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">

            {{-- CONTACT FORM --}}
            <div class="col-lg-6">
                <div class="contact-card p-4 p-md-5">

                    {{-- Success message at top --}}
                    @if(session('success'))
                        <div class="alert alert-success text-center fw-semibold mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="mb-4 text-center">Send Us a Message</h3>

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea name="message" rows="5" class="form-control" placeholder="Write your message..." required></textarea>
                        </div>

                        <button class="btn btn-primary w-100 py-2 fw-bold">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            {{-- CONTACT INFO --}}
            <div class="col-lg-4">
                <div class="contact-card p-4 p-md-5 h-100">
                    <h4 class="mb-4 text-center">Contact Information</h4>

                    <p class="mb-3 d-flex align-items-center">
                        <span class="icon-box"><i class="bi bi-envelope"></i></span>
                        sabbirhasan.web@gmail.com
                    </p>

                    <p class="mb-3 d-flex align-items-center">
                        <span class="icon-box"><i class="bi bi-telephone"></i></span>
                        +880 01750-512161
                    </p>

                    <p class="mb-4 d-flex align-items-center">
                        <span class="icon-box"><i class="bi bi-geo-alt"></i></span>
                        Bangladesh
                    </p>

                    <h6 class="mb-3 text-center">Follow Us</h6>
                    <div class="d-flex justify-content-center social-links">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
