<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<body style="margin:0; font-family: 'Segoe UI', sans-serif; background-color:#f5f5f5; color:#212529;">

    <!-- Sidebar Toggle Button for small screens -->
    <button class="btn btn-dark d-md-none position-fixed" 
            style="top:15px; left:15px; z-index:1050;" 
            onclick="document.getElementById('sidebar').classList.toggle('d-none')">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="d-flex flex-column position-fixed vh-100 shadow-sm"
         style="width:260px; background-color:#ffffff; border-right:1px solid #dee2e6; padding:1rem; z-index:1040;">

        <!-- Logo / Site Name Display -->
        <div class="mb-4 text-center">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                @if($setting?->logo)
                    <img src="{{ $setting->logo_url }}" alt="Logo" height="50" class="mb-2">
                @else
                    <h4 class="fw-bold text-primary mb-0">{{ $setting->site_name ?? 'MyAdmin' }}</h4>
                @endif
            </a>
        </div>

        <!-- Navigation -->
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- Dashboard -->
            <li class="nav-item mb-1">
                <a href="{{ route('dashboard') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active text-white bg-primary' : 'text-dark' }}"
                   style="border-radius:10px; padding:10px 15px; transition:0.3s;">
                    <i class="bi bi-house-door me-3 fs-5"></i> Dashboard
                </a>
            </li>

            <!-- Contact Messages -->
            <li class="nav-item mb-1">
                <a href="{{ route('contact.list') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('contact.*') ? 'active text-white bg-primary' : 'text-dark' }}"
                   style="border-radius:10px; padding:10px 15px; transition:0.3s;">
                    <i class="bi bi-chat-left-text me-3 fs-5"></i> Contact Messages
                </a>
            </li>

            <!-- Blog Posts -->
            <li class="nav-item mb-1">
                <a href="{{ route('blog.list') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('blog.*') ? 'active text-white bg-primary' : 'text-dark' }}"
                   style="border-radius:10px; padding:10px 15px; transition:0.3s;">
                    <i class="bi bi-journal-text me-3 fs-5"></i> Blog Posts
                </a>
            </li>

            <!-- Categories -->
            <li class="nav-item mb-1">
                <a href="{{ route('category.list') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('category.*') ? 'active text-white bg-primary' : 'text-dark' }}"
                   style="border-radius:10px; padding:10px 15px; transition:0.3s;">
                    <i class="bi bi-tags me-3 fs-5"></i> Categories
                </a>
            </li>

            <!-- FAQ -->
            <li class="nav-item mb-1">
                <a href="{{ route('faq.list') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('faq.*') ? 'active text-white bg-primary' : 'text-dark' }}"
                   style="border-radius:10px; padding:10px 15px; transition:0.3s;">
                    <i class="bi bi-question-circle me-3 fs-5"></i> FAQ
                </a>
            </li>

            <!-- Author -->
            <li class="nav-item mb-1">
                <a href="{{ route('author.list') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('author.*') ? 'active text-white bg-primary' : 'text-dark' }}"
                   style="border-radius:10px; padding:10px 15px; transition:0.3s;">
                    <i class="bi bi-person-lines-fill me-3 fs-5"></i> Author List
                </a>
            </li>

            <!-- Site Setting -->
            <li class="nav-item mb-1">
                <a href="{{ route('setting.list') }}"
                   class="nav-link d-flex align-items-center {{ request()->routeIs('setting.*') ? 'active text-white bg-primary' : 'text-dark' }}"
                   style="border-radius:10px; padding:10px 15px; transition:0.3s;">
                    <i class="bi bi-gear me-3 fs-5"></i> Site Setting
                </a>
            </li>
        </ul>

        <!-- Footer / Logout -->
        <div class="mt-auto pt-3 border-top">
            <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar toggle for small screens
        const sidebar = document.getElementById('sidebar');
        if(window.innerWidth < 768){
            sidebar.classList.add('d-none');
        }
        window.addEventListener('resize', function(){
            if(window.innerWidth >= 768){
                sidebar.classList.remove('d-none');
            } else {
                sidebar.classList.add('d-none');
            }
        });
    </script>
</body>
