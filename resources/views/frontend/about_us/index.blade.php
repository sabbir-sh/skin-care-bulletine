@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')

<section class="about-hero">
    <style>
        .about-hero {
            background: linear-gradient(135deg, #f8f9fa, #eef1f5);
            padding: 80px 0;
        }
        .about-title {
            font-size: 2.8rem;
            font-weight: 800;
        }
        .about-subtitle {
            color: #6c757d;
            max-width: 800px;
            margin: 20px auto 0;
        }

        .about-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 12px 35px rgba(0,0,0,.08);
            height: 100%;
        }

        .about-icon {
            font-size: 36px;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        /* 📱 Mobile */
        @media (max-width: 575px) {
            .about-title {
                font-size: 2rem;
            }
        }
    </style>

    <div class="container text-center">
        <h1 class="about-title">About Our Blog</h1>
        <p class="about-subtitle lead">
            A trusted platform for insightful articles, knowledge sharing, and meaningful stories —
            created for readers who value quality content.
        </p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">

            {{-- Our Story --}}
            <div class="col-md-6">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <h3>Our Story</h3>
                    <p class="text-muted">
                        Our blog started with a simple idea — to create a space where ideas,
                        experiences, and knowledge could be shared freely. Over time, it has grown
                        into a platform that connects readers with well-researched articles,
                        trending topics, and thoughtful insights across multiple categories.
                    </p>
                    <p class="text-muted">
                        We believe that words have power, and through our content,
                        we aim to inform, inspire, and engage our audience every day.
                    </p>
                </div>
            </div>

            {{-- Our Mission --}}
            <div class="col-md-6">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p class="text-muted">
                        Our mission is to deliver high-quality, reliable, and engaging blog content
                        that adds real value to our readers’ lives. We focus on accuracy,
                        relevance, and clarity — ensuring every article meets a high editorial standard.
                    </p>
                    <p class="text-muted">
                        Whether it’s technology, lifestyle, health, or current trends,
                        our goal is to make information easy to understand and enjoyable to read.
                    </p>
                </div>
            </div>

            {{-- What We Cover --}}
            <div class="col-md-6">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-grid"></i>
                    </div>
                    <h3>What We Cover</h3>
                    <ul class="text-muted ps-3">
                        <li>Technology & Innovation</li>
                        <li>Lifestyle & Wellness</li>
                        <li>Health & Beauty</li>
                        <li>Business & Entrepreneurship</li>
                        <li>Tips, Guides & Tutorials</li>
                    </ul>
                </div>
            </div>

            {{-- Why Choose Us --}}
            <div class="col-md-6">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-stars"></i>
                    </div>
                    <h3>Why Choose Us</h3>
                    <p class="text-muted">
                        ✔ Carefully curated content<br>
                        ✔ Reader-first approach<br>
                        ✔ Clean, ad-light reading experience<br>
                        ✔ Mobile-friendly design<br>
                        ✔ Regularly updated articles
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Join Our Community</h2>
        <p class="text-muted mb-4">
            Stay connected with us and explore stories that matter.
            Follow us for the latest updates, featured articles, and insights.
        </p>
        <a href="{{ url('/') }}" class="btn btn-primary px-4">
            Explore Blogs →
        </a>
    </div>
</section>

@endsection
