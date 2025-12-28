<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Sidebar</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
        }

        /* Sidebar */
        #sidebar {
            width: 260px;
            background-color: #141414;
            border-right: 1px solid #dee2e6;
            padding: 1rem;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 1040;
        }

        /* Search bar */
        .sidebar-search {
            position: relative;
            margin-bottom: 1.2rem;
        }

        .sidebar-search input {
            padding-left: 42px;
            height: 44px;
            border-radius: 12px;
            font-size: 14px;
        }

        .sidebar-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 16px;
        }

        /* Nav links */
        .nav-link {
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: #344274;
        }

        .nav-link.active {
            background-color: #344274 !important;
            color: #ffffff !important;
        }

        /* Mobile toggle */
        .sidebar-toggle {
            top: 15px;
            left: 15px;
            z-index: 1050;
        }

        /* Mobile view */
        @media (max-width: 767px) {
            #sidebar {
                width: 100%;
                max-width: 260px;
                overflow-y: auto;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar Toggle Button (Mobile) -->
<button class="btn btn-dark d-md-none position-fixed sidebar-toggle"
        onclick="document.getElementById('sidebar').classList.toggle('d-none')">
    <i class="bi bi-list"></i>
</button>

<!-- Sidebar -->
<div id="sidebar" class="shadow-sm">

    <!-- Logo -->
    <div class="mb-3 text-center">
        <a href="{{ route('dashboard') }}" class="text-decoration-none">
            @if($setting?->logo)
                <img src="{{ $setting->logo_url }}" alt="Logo" height="48" class="mb-2">
            @else
                <h4 class="fw-bold text-primary mb-0">
                    {{ $setting->site_name ?? 'MyAdmin' }}
                </h4>
            @endif
        </a>
    </div>

    <!-- Search -->
    <div class="sidebar-search">
        <i class="bi bi-search"></i>
        <input type="text" id="menuSearch" class="form-control" placeholder="Search menu...">
    </div>

    <!-- Menu -->
    <ul class="nav nav-pills flex-column" id="menuList">

        <li class="nav-item mb-1">
            <a href="{{ route('dashboard') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : 'text-white' }}">
                <i class="bi bi-house-door me-3 fs-5"></i>Dashboard
            </a>
        </li>

<li class="nav-item mb-1">
    {{-- Parent --}}
    <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('blood-group.*') || request()->routeIs('donor.*') ? '' : 'collapsed' }}"
       data-bs-toggle="collapse"
       href="#bloodFunctionMenu"
       role="button"
       aria-expanded="{{ request()->routeIs('blood-group.*') || request()->routeIs('donor.*') ? 'true' : 'false' }}"
       aria-controls="bloodFunctionMenu">
        <div class="d-flex align-items-center">
            <i class="bi bi-droplet me-3 fs-5"></i> Blood Function
        </div>
        <i class="bi bi-chevron-down small"></i>
    </a>

    {{-- Sub-items --}}
    <div class="collapse {{ request()->routeIs('blood-group.*') || request()->routeIs('donor.*') ? 'show' : '' }}" id="bloodFunctionMenu">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li>
                <a href="{{ route('blood-group.list') }}" class="nav-link {{ request()->routeIs('blood-group.*') ? 'active' : 'text-white' }}">
                   Blood Groups
                </a>
            </li>
            <li>
                <a href="{{ route('donor.list') }}" class="nav-link {{ request()->routeIs('donor.*') ? 'active' : 'text-white' }}">
                   Donors
                </a>
            </li>
        </ul>
    </div>
</li>




        <li class="nav-item mb-1">
            <a href="{{ route('contact.list') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('contact.*') ? 'active' : 'text-white' }}">
                <i class="bi bi-chat-left-text me-3 fs-5"></i>Contact Messages
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="{{ route('blog.list') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('blog.*') ? 'active' : 'text-white' }}">
                <i class="bi bi-journal-text me-3 fs-5"></i>Blog Posts
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="{{ route('category.list') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('category.*') ? 'active' : 'text-white' }}">
                <i class="bi bi-tags me-3 fs-5"></i>Categories
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="{{ route('faq.list') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('faq.*') ? 'active' : 'text-white' }}">
                <i class="bi bi-question-circle me-3 fs-5"></i>FAQ
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="{{ route('author.list') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('author.*') ? 'active' : 'text-white' }}">
                <i class="bi bi-person-lines-fill me-3 fs-5"></i>Author List
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="{{ route('setting.list') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('setting.*') ? 'active' : 'text-white' }}">
                <i class="bi bi-gear me-3 fs-5"></i>Site Setting
            </a>
        </li>

    </ul>

    <!-- Logout -->
    <div class="mt-auto pt-3 border-top">
        <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const sidebar = document.getElementById('sidebar');

    if (window.innerWidth < 768) {
        sidebar.classList.add('d-none');
    }

    window.addEventListener('resize', () => {
        window.innerWidth >= 768
            ? sidebar.classList.remove('d-none')
            : sidebar.classList.add('d-none');
    });

    // Menu search
    document.getElementById('menuSearch').addEventListener('keyup', function () {
        const value = this.value.toLowerCase();
        document.querySelectorAll('#menuList .nav-item').forEach(item => {
            item.style.display = item.innerText.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>

</body>
</html>
