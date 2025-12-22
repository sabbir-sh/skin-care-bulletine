<!-- resources/views/layouts/header.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
    <div class="container">
        <!-- Brand / Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            @if($setting?->logo)
                <img src="{{ $setting->logo_url }}" alt="Logo" height="50" class="d-inline-block align-text-top">
            @else
                <span class="fw-bold text-primary fs-4">{{ $setting->site_name ?? 'MyAdmin' }}</span>
            @endif
        </a>

        <!-- Toggler / Mobile Menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center text-lg-start">
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="/blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="/about-us">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="/contact-us">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
/* Optional: Add hover effects and spacing */
.navbar-nav .nav-link {
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #0d6efd;
}

@media (max-width: 991px) {
    /* Center navbar links under logo on mobile */
    .navbar-nav {
        margin-top: 1rem;
    }
}
</style>
