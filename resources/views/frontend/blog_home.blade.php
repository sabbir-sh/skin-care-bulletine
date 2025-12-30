@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- ================= HERO SECTION ================= --}}
    <section style="padding: clamp(50px, 8vw, 90px) 0; background: #fff;">
        <div class="container">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    @foreach($heroBlogs as $index => $blog)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row align-items-center g-4">
                                <div class="col-lg-6 order-2 order-lg-1">
                                    <span
                                        style="background: #dc3545; color: #fff; padding: 5px 15px; border-radius: 50px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; display: inline-block;">
                                        {{ $blog->category->name }}
                                    </span>

                                    <h1
                                        style="font-size: clamp(1.8rem, 5vw, 3rem); font-weight: 900; line-height: 1.2; color: #212529; margin-bottom: 20px;">
                                        {{ $blog->title }}
                                    </h1>

                                    <p style="color: #6c757d; font-size: 1.1rem; line-height: 1.6; margin-bottom: 30px;">
                                        {{ Str::limit(strip_tags($blog->content), 160) }}
                                    </p>

                                    <a href="{{ route('blog.show', $blog->slug) }}"
                                        style="background: #212529; color: #fff; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: 0.3s; display: inline-block;"
                                        onmouseover="this.style.backgroundColor='#dc3545'"
                                        onmouseout="this.style.backgroundColor='#212529'">
                                        Read Article <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>

                                <div class="col-lg-6 order-1 order-lg-2">
                                    <a href="{{ route('blog.show', $blog->slug) }}" style="text-decoration: none;">
                                        <div
                                            style="border-radius: 24px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                                            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}"
                                                style="width: 100%; height: clamp(260px, 40vw, 450px); object-fit: cover; transition: 0.5s;"
                                                onmouseover="this.style.transform='scale(1.05)'"
                                                onmouseout="this.style.transform='scale(1)'">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- ================= TRENDING ================= --}}
    <section style="padding: 60px 0; background: #fcfcfc;">
        <div class="container">
            <h2
                style="font-weight: 800; margin-bottom: 30px; position: relative; padding-left: 15px; border-left: 5px solid #dc3545;">
                Trending Now</h2>

            <div class="row g-3 g-md-4">
                @foreach($trending as $blog)
                    <div class="col-12 col-md-4">
                        <a href="{{ route('blog.show', $blog->slug) }}"
                            style="position: relative; border-radius: 16px; overflow: hidden; display: block; height: 280px; text-decoration: none; group">
                            <img src="{{ asset($blog->featured_image) }}"
                                style="width: 100%; height: 100%; object-fit: cover; transition: 0.6s;">
                            <div
                                style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent); padding: 20px; display: flex; flex-direction: column; justify-content: flex-end; color: #fff;">
                                <span
                                    style="font-size: 11px; text-transform: uppercase; background: rgba(220, 53, 69, 0.8); padding: 2px 10px; border-radius: 4px; align-self: flex-start; margin-bottom: 10px;">{{ $blog->category->name }}</span>
                                <h5 style="font-weight: 700; line-height: 1.4; margin: 0;">{{ Str::limit($blog->title, 50) }}
                                </h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= LATEST & SIDEBAR ================= --}}
    <section style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div class="row g-5">
                {{-- LEFT: LATEST BLOGS --}}
                <div class="col-lg-8">
                    <h2 style="font-weight: 800; margin-bottom: 40px;">Latest Articles</h2>
                    <div class="row g-4">
                        @foreach($blogs as $blog)
                            <div class="col-sm-6 col-md-6">
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    style="text-decoration: none; color: inherit; display: block; height: 100%; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.3s;"
                                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.1)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.05)'">

                                    <img src="{{ asset($blog->featured_image) }}"
                                        style="width: 100%; height: 200px; object-fit: cover;">

                                    <div style="padding: 20px;">
                                        <div
                                            style="display: flex; gap: 10px; font-size: 12px; color: #6c757d; margin-bottom: 10px;">
                                            <span><i class="bi bi-calendar3 me-1"></i>
                                                {{ $blog->created_at->format('M d, Y') }}</span>
                                            <span><i class="bi bi-clock me-1"></i> 5 min read</span>
                                        </div>
                                        <h5 style="font-weight: 700; margin-bottom: 12px; line-height: 1.4; color: #212529;">
                                            {{ Str::limit($blog->title, 55) }}</h5>
                                        <p style="font-size: 14px; color: #6c757d; margin-bottom: 15px;">
                                            {{ Str::limit(strip_tags($blog->content), 90) }}</p>
                                        <span style="color: #dc3545; font-weight: 700; font-size: 14px;">Read More <i
                                                class="bi bi-arrow-right small"></i></span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- RIGHT: SIDEBAR --}}
                <div class="col-lg-4">
                    <div style="position: sticky; top: 20px;">
                        {{-- Search --}}
                        <div style="background: #f8f9fa; padding: 25px; border-radius: 20px; margin-bottom: 30px;">
                            <h5 style="font-weight: 700; margin-bottom: 15px;">Search</h5>
                            <div style="position: relative;">
                                <input type="text" placeholder="Search articles..."
                                    style="width: 100%; padding: 12px 15px; border-radius: 12px; border: 1px solid #ddd; outline: none;">
                                <i class="bi bi-search"
                                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
                            </div>
                        </div>

                        {{-- Categories --}}
                        <div
                            style="background: #fff; padding: 25px; border-radius: 20px; border: 1px solid #eee; margin-bottom: 30px;">
                            <h5
                                style="font-weight: 700; margin-bottom: 20px; border-bottom: 2px solid #dc3545; display: inline-block;">
                                Categories</h5>
                            @foreach($categories as $category)
                                <a href="{{ url('category/' . $category->slug) }}"
                                    style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; color: #444; text-decoration: none; border-bottom: 1px dashed #eee; transition: 0.3s;"
                                    onmouseover="this.style.color='#dc3545'; this.style.paddingLeft='5px'"
                                    onmouseout="this.style.color='#444'; this.style.paddingLeft='0'">
                                    <span>{{ $category->name }}</span>
                                    <span style="background: #f8f9fa; font-size: 11px; padding: 2px 8px; border-radius: 10px;">
                                        {{ $category->blogs_count ?? 0 }}
                                    </span>
                                </a>
                            @endforeach
                        </div>

                        {{-- Social --}}
                        <div style="background: #212529; padding: 25px; border-radius: 20px; color: #fff;">
                            <h5 style="font-weight: 700; margin-bottom: 20px;">Follow Fighters</h5>
                            <div style="display: flex; gap: 10px;">
                                @foreach(['facebook', 'instagram', 'youtube', 'twitter-x'] as $social)
                                    <a href="#"
                                        style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: 0.3s;"
                                        onmouseover="this.style.background='#dc3545'"
                                        onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                        <i class="bi bi-{{ $social }}"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= FAQs ================= --}}
    <section style="padding: 80px 0; background: #f8f9fa;">
        <div class="container" style="max-width: 800px;">
            <div class="text-center mb-5">
                <h2 style="font-weight: 800; color: #212529;">Frequently Asked Questions</h2>
                <p class="text-muted">রক্তদান সম্পর্কে সাধারণ কিছু জিজ্ঞাসার উত্তর</p>
            </div>

            <div class="accordion accordion-flush" id="faqAccordion"
                style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                @foreach($faqs as $key => $faq)
                    <div class="accordion-item" style="border-bottom: 1px solid #eee;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $key }}"
                                style="padding: 20px; font-weight: 600; font-size: 1rem; color: #212529;">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body"
                                style="padding: 20px; color: #6c757d; line-height: 1.7; background: #fff;">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= JS ================= --}}
    <script>
        // Hero Image Hover logic handle via JS since hover on parent is needed
        document.querySelectorAll('.carousel-item').forEach(item => {
            const img = item.querySelector('img');
            const link = item.querySelector('.hero-img-link');
            if (link) {
                link.addEventListener('mouseenter', () => img.style.transform = 'scale(1.05)');
                link.addEventListener('mouseleave', () => img.style.transform = 'scale(1)');
            }
        });
    </script>

    <style>
        /* Custom Scrollbar for better UI */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #dc3545;
            border-radius: 10px;
        }

        /* Accordion Customization */
        .accordion-button:not(.collapsed) {
            background-color: #fff5f5 !important;
            color: #dc3545 !important;
            box-shadow: none !important;
        }

        .accordion-button::after {
            background-size: 15px;
        }
    </style>

@endsection