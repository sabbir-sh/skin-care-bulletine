@extends('frontend.layouts.app')

@section('title', 'Home Page')

@section('content')
<style>
    /* CSS for the complete design */
    
    /* 1. Reset and Global Styles */
    :root {
        --primary-color: #007bff; /* Blue */
        --secondary-color: #6c757d; /* Gray */
        --accent-color: #28a745; /* Green */
        --background-color: #f8f9fa; /* Light Gray */
        --text-color: #343a40; /* Dark Gray */
    }
    
    .page-content {
        font-family: 'Arial', sans-serif;
        color: var(--text-color);
        line-height: 1.6;
        min-height: 100vh; /* Ensure full viewport height */
        display: flex;
        flex-direction: column;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px 0;
    }

    /* 2. Hero Section */
    .hero-section {
        background-color: #ffffff; /* White background */
        text-align: center;
        padding: 100px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .hero-title {
        font-size: 3.5rem;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .hero-subtitle {
        font-size: 1.5rem;
        color: var(--secondary-color);
        margin-bottom: 30px;
    }

    .cta-button {
        display: inline-block;
        background-color: var(--accent-color);
        color: white !important; /* !important for inline override */
        padding: 12px 30px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: bold;
        transition: background-color 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .cta-button:hover {
        background-color: #218838; /* Darker Green */
    }

    /* 3. Features Section */
    .features-section {
        background-color: var(--background-color);
        padding: 60px 0;
        text-align: center;
    }

    .section-heading {
        font-size: 2.5rem;
        color: var(--text-color);
        margin-bottom: 40px;
        position: relative;
        padding-bottom: 10px;
    }

    .section-heading::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background-color: var(--primary-color);
        margin: 10px auto 0;
    }

    .features-grid {
        display: flex;
        justify-content: space-around;
        gap: 20px;
        flex-wrap: wrap; /* Allows wrapping on smaller screens */
    }

    .feature-item {
        flex: 1;
        min-width: 250px;
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 15px;
        /* Using a common font icon or a simple character as a placeholder */
    }

    .feature-title {
        font-size: 1.4rem;
        color: var(--text-color);
        margin-bottom: 10px;
        font-weight: bold;
    }

    .feature-description {
        font-size: 1rem;
        color: var(--secondary-color);
    }

    /* 4. Secondary CTA Section */
    .secondary-cta {
        background-color: var(--primary-color);
        color: white;
        padding: 40px 0;
        text-align: center;
    }

    .cta-text {
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    /* 5. Simple Footer (Assuming a full footer is in the layout) */
    .page-footer-content {
        text-align: center;
        padding: 20px 0;
        border-top: 1px solid #dee2e6;
        color: var(--secondary-color);
        font-size: 0.9rem;
        background-color: #fff;
    }

</style>

<div class="page-content">
    
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title" style="color: #007bff; font-weight: 700;">
                Revolutionize Your Workflow Today
            </h1>
            <p class="hero-subtitle">
                The modern, simple, and powerful solution for all your needs. Join thousands of happy users!
            </p>
            <a href="/get-started" class="cta-button" style="background-color: #28a745;">
                Get Started Free →
            </a>
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <h2 class="section-heading">
                Why Choose MyWebsite?
            </h2>
            <div class="features-grid">
                
                <div class="feature-item">
                    <div class="feature-icon">🚀</div> <h3 class="feature-title">Blazing Fast</h3>
                    <p class="feature-description">Our platform is optimized for speed, ensuring a lag-free experience every time.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">✨</div> <h3 class="feature-title">Modern Design</h3>
                    <p class="feature-description">Enjoy a beautiful, intuitive interface that makes complex tasks simple.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">🛡️</div> <h3 class="feature-title">Top-Tier Security</h3>
                    <p class="feature-description">Your data is safe with us. We use advanced encryption and security measures.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                @forelse($blogs as $blog)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 overflow-hidden">
                            @if($blog->featured_image)
                                <a href="{{ route('blog.show', $blog->slug) }}">
                                    <img src="{{ asset($blog->featured_image) }}" class="card-img-top" alt="{{ $blog->title }}"
                                        style="height:200px; object-fit:cover;">
                                </a>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title fw-semibold">{{ $blog->title }}</h5>
                                </a>
                                <p class="card-text text-truncate" style="max-height:60px;">
                                    {!! Str::limit(strip_tags($blog->content), 120) !!}</p>
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    class="btn btn-primary mt-auto align-self-start">
                                    Read More <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <small class="text-muted">Published: {{ $blog->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No blogs found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</div>
@endsection