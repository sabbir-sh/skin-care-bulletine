<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sidebar - Modern Pro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --sidebar-bg: #0f172a; /* Premium Dark Navy */
            --sidebar-hover: #1e293b;
            --accent-primary: #3b82f6; /* Modern Blue */
            --text-muted: #94a3b8;
            --sidebar-width: 270px;
        }

        body {
            margin: 0;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: #f8fafc;
        }

        /* Sidebar Main Container */
        #sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 1040;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.1);
        }

        /* Logo Area - Fixed */
        .sidebar-header {
            padding: 1.5rem;
            flex-shrink: 0; 
        }

        .logo-text {
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Search Bar - Fixed */
        .sidebar-search {
            padding: 0 1.25rem 1.25rem;
            position: relative;
            flex-shrink: 0;
        }

        .sidebar-search input {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding-left: 42px;
            border-radius: 12px;
            height: 44px;
            font-size: 14px;
            transition: 0.3s;
        }

        .sidebar-search input:focus {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            color: white;
        }

        .sidebar-search i {
            position: absolute;
            left: 32px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 16px;
        }

        /* Menu Content - Scrollable (Single Scrollbar) */
        .sidebar-menu-wrapper {
            flex-grow: 1;
            overflow-y: auto;
            padding: 0 1rem;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.1) transparent;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar-menu-wrapper::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        /* Nav Links */
        .nav-link {
            color: var(--text-muted) !important;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 4px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }

        .nav-link i {
            font-size: 1.2rem;
            width: 28px;
            margin-right: 12px;
            transition: transform 0.3s;
        }

        .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: #fff !important;
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .nav-link.active i {
            color: #fff;
        }

        /* Submenu Styling */
        .submenu-list {
            list-style: none;
            padding: 5px 0 5px 40px;
        }

        .submenu-list .nav-link {
            font-size: 0.9rem;
            padding: 8px 12px;
            margin-bottom: 2px;
        }

        /* Logout Footer - Fixed */
        .sidebar-footer {
            padding: 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            flex-shrink: 0;
        }

        .btn-logout {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        /* Mobile Adjustments */
        .sidebar-toggle {
            top: 15px;
            left: 15px;
            z-index: 1050;
            border-radius: 10px;
            padding: 8px 12px;
        }

        @media (max-width: 767px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>

<button class="btn btn-dark d-md-none position-fixed sidebar-toggle" id="toggleMenu">
    <i class="bi bi-list fs-4"></i>
</button>

<div id="sidebar" class="shadow">

    <div class="sidebar-header text-center">
        <a href="{{ route('dashboard') }}" class="logo-text">
            @if($setting?->logo)
            {{ $setting->site_name ?? 'BLOODFIGHTERS ' }}
                {{-- <img src="{{ $setting->logo_url }}" alt="Logo" height="42"> --}}
            @else
                <h4 class="fw-bold mb-0" style="color: white;">
                    <i class="bi bi-shield-lock-fill text-primary me-2"></i>
                    {{ $setting->site_name ?? 'BLOODFIGHTERS ' }}
                </h4>
            @endif
        </a>
    </div>

    <div class="sidebar-search">
        <i class="bi bi-search"></i>
        <input type="text" id="menuSearch" class="form-control" placeholder="Search menus...">
    </div>

    <div class="sidebar-menu-wrapper">
        <ul class="nav flex-column" id="menuList">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('blood-group.*') || request()->routeIs('donor.*') ? '' : 'collapsed' }}"
                   data-bs-toggle="collapse"
                   href="#bloodFunctionMenu"
                   role="button"
                   aria-expanded="{{ request()->routeIs('blood-group.*') || request()->routeIs('donor.*') ? 'true' : 'false' }}">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-droplet-fill text-danger"></i> Blood Function
                    </div>
                    <i class="bi bi-chevron-down small opacity-50"></i>
                </a>

                <div class="collapse {{ request()->routeIs('blood-group.*') || request()->routeIs('donor.*') ? 'show' : '' }}" id="bloodFunctionMenu">
                    <ul class="submenu-list">
                        <li>
                            <a href="{{ route('blood-group.list') }}" class="nav-link {{ request()->routeIs('blood-group.*') ? 'active' : '' }}">
                                Blood Groups
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('donor.list') }}" class="nav-link {{ request()->routeIs('donor.*') ? 'active' : '' }}">
                                Donors
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="{{ route('contact.list') }}"
                   class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-left-dots"></i> Contact Messages
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('blog.list') }}"
                   class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-richtext"></i> Blog Posts
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('category.list') }}"
                   class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Categories
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('faq.list') }}"
                   class="nav-link {{ request()->routeIs('faq.*') ? 'active' : '' }}">
                    <i class="bi bi-patch-question"></i> FAQ
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('author.list') }}"
                   class="nav-link {{ request()->routeIs('author.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i> Author List
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('setting.list') }}"
                   class="nav-link {{ request()->routeIs('setting.*') ? 'active' : '' }}">
                    <i class="bi bi-gear-wide-connected"></i> Site Setting
                </a>
            </li>

        </ul>
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('logout') }}" class="btn-logout">
            <i class="bi bi-box-arrow-right me-2"></i> Logout System
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Handle Mobile View Sidebar Toggle
    const toggleBtn = document.getElementById('toggleMenu');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth < 768 && !sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });

    // Sidebar Search Logic
    document.getElementById('menuSearch').addEventListener('keyup', function () {
        const query = this.value.toLowerCase();
        const menuItems = document.querySelectorAll('#menuList > .nav-item');

        menuItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(query)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>