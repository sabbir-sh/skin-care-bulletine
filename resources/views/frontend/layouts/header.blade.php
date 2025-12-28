<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top py-3" style="background-color: #b42701;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            @if($setting?->logo)
                <img src="{{ $setting->logo_url }}" alt="Logo" height="50" class="d-inline-block align-text-top">
            @else
                <span class="fw-bold fs-3" style="color: #030303;">{{ $setting->site_name ?? 'রক্তদান' }}</span>
            @endif
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center text-lg-start align-items-center">
                <li class="nav-item">
                    <a class="nav-link fw-bold mx-2 px-3 text-dark" style="color: #000000 !important;" href="/">হোম</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold mx-2 px-3 text-dark" style="color: #000000 !important;"
                        href="/blog">ব্লগ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold mx-2 px-3 text-dark" style="color: #000000 !important;"
                        href="/about-us">আমাদের সম্পর্কে</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold mx-2 px-3 text-dark" style="color: #000000 !important;"
                        href="/contact-us">যোগাযোগ</a>
                </li>

                {{-- দাতা হন বাটনটি প্রয়োজন হলে নিচের কোডটি আনকমেন্ট করুন --}}
                {{--
                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                    <a class="btn shadow-sm text-white px-4 rounded-pill fw-bold" style="background-color: #e63f11;"
                        href="/register">দাতা হন</a>
                </li>
                --}}
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-nav .nav-link {
        color: #333 !important;
        font-size: 1.1rem;
        position: relative;
        transition: 0.3s;
    }

    .navbar-nav .nav-link:hover {
        color: #e63f11 !important;
    }

    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 3px;
        background: #e63f11;
        bottom: 0;
        left: 15%;
        transition: 0.4s;
        border-radius: 5px;
    }

    .navbar-nav .nav-link:hover::after {
        width: 70%;
    }

    @media (max-width: 991px) {
        .navbar-nav {
            margin-top: 1.5rem;
        }

        .nav-link::after {
            display: none;
        }
    }
</style>