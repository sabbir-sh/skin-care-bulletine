@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- ================= HERO SECTION ================= --}}
    <section class="hero-modern">
        <style>
            .hero-modern {
                padding: 90px 0;
            }

            .hero-title {
                font-size: 2.8rem;
                font-weight: 800;
            }

            .hero-desc {
                color: #555;
                margin: 20px 0;
            }

            .hero-img-box {
                border-radius: 18px;
                overflow: hidden;
            }

            .hero-img-box img {
                width: 100%;
                height: 420px;
                object-fit: cover;
                transition: transform .6s ease;
            }

            /* 📱 Mobile */
            @media (max-width: 767px) {
                .hero-modern {
                    padding: 50px 0;
                }

                .hero-title {
                    font-size: 1.9rem;
                }

                .hero-img-box img {
                    height: 260px;
                }
            }
        </style>

        <div class="container">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">

                    @foreach($heroBlogs as $index => $blog)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row align-items-center g-4">
                                <div class="col-lg-6 order-2 order-lg-1">
                                    <span class="badge bg-primary mb-3">
                                        {{ $blog->category->name }}
                                    </span>

                                    <h1 class="hero-title">
                                        {{ $blog->title }}
                                    </h1>

                                    <p class="hero-desc">
                                        {{ Str::limit(strip_tags($blog->content), 160) }}
                                    </p>

                                    <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-dark px-4">
                                        Read Article →
                                    </a>
                                </div>

                                <div class="col-lg-6 order-1 order-lg-2">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="hero-img-link">
                                        <div class="hero-img-box">
                                            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}">
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- Controls --}}
                {{-- <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button> --}}
            </div>
        </div>
    </section>


    {{-- ================= TRENDING ================= --}}
    <section class="py-5 trending-section">
        <style>
            .trend-card {
                position: relative;
                border-radius: 14px;
                overflow: hidden;
                display: block;
            }

            .trend-card img {
                width: 100%;
                height: 260px;
                object-fit: cover;
                transition: transform .6s ease;
            }

            .trend-card:hover img {
                transform: scale(1.08);
            }

            .trend-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(0, 0, 0, .85), transparent);
                color: #fff;
                padding: 20px;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
            }

            /* 📱 Mobile trending */
            @media (max-width: 767px) {
                .trend-card img {
                    height: 200px;
                }
            }
        </style>

        <div class="container">
            <h2 class="section-title text-start">Trending</h2>

            <div class="row g-4">
                @foreach($trending as $blog)
                    <div class="col-12 col-md-4">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="trend-card">
                            <img src="{{ asset($blog->featured_image) }}">
                            <div class="trend-overlay">
                                <span class="small">{{ $blog->category->name }}</span>
                                <h5>{{ Str::limit($blog->title, 55) }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= LATEST ================= --}}
    <section class="py-5 latest-section">
        <style>
            /* ===== Blog Cards ===== */
            .editorial-card {
                border-radius: 14px;
                overflow: hidden;
                background: #fff;
                box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
                transition: transform .3s ease, box-shadow .3s ease;
                height: 100%;
                display: block;
                color: inherit;
                text-decoration: none;
            }

            .editorial-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 16px 40px rgba(0, 0, 0, .12);
            }

            .editorial-card img {
                width: 100%;
                height: 220px;
                object-fit: cover;
            }

            /* ===== Sidebar ===== */
            .sidebar-box {
                background: #fff;
                border-radius: 14px;
                padding: 20px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
            }

            .sidebar-box h5 {
                font-weight: 700;
                margin-bottom: 15px;
            }

            .category-list a {
                display: block;
                padding: 8px 0;
                color: #333;
                text-decoration: none;
                font-weight: 500;
            }

            .category-list a:hover {
                color: #0d6efd;
            }

            .social-icons a {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #f1f3f5;
                color: #333;
                margin-right: 10px;
                transition: .3s;
            }

            .social-icons a:hover {
                background: #0d6efd;
                color: #fff;
            }

            /* 📱 Mobile */
            @media (max-width: 575px) {
                .editorial-card img {
                    height: 160px;
                }
            }
        </style>

        <div class="container">
            <div class="row g-4">

                {{-- ================= LEFT: LATEST BLOGS ================= --}}
                <div class="col-lg-8">
                    <h2 class="section-title text-start mb-4">Latest Articles</h2>

                    <div class="row g-3 g-md-4">
                        @foreach($blogs as $blog)
                            <div class="col-6 col-md-4">
                                {{-- Mobile: 2 per row | Desktop: 3 per row --}}
                                <a href="{{ route('blog.show', $blog->slug) }}" class="editorial-card">
                                    <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}">

                                    <div class="p-2 p-md-3 d-flex flex-column h-100">
                                        <small class="text-muted mb-1">
                                            {{ $blog->created_at->format('M d, Y') }}
                                        </small>

                                        <h5 class="mb-1">{{ $blog->title }}</h5>

                                        <p class="flex-grow-1 mb-2">
                                            {{ Str::limit(strip_tags($blog->content), 90) }}
                                        </p>

                                        <span class="fw-semibold text-primary">
                                            Read more →
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ================= RIGHT: SIDEBAR ================= --}}
                <div class="col-lg-4">

                    {{-- Categories --}}
                    <div class="sidebar-box mb-4">
                        <h5>Categories</h5>
                        <div class="category-list">
                            @foreach($categories as $category)
                                <a href="{{ url('category/' . $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Social Icons --}}
                    <div class="sidebar-box">
                        <h5>Follow Us</h5>
                        <div class="social-icons">
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

    {{-- ================= JS ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.editorial-card, .trend-card');

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });

            cards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                observer.observe(card);
            });
        });
    </script>

@endsection