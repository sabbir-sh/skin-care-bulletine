<!-- Sidebar -->
<div class="d-flex flex-column flex-shrink-0 vh-100 position-fixed text-white"
    style="width: 250px; background: linear-gradient(180deg, #ffffff 0%, #12121b 100%); padding: 20px;">
    
  

    <hr style="border-color: rgba(255,255,255,0.1); margin: 0 0 20px;">

    <!-- Navigation -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active bg-primary' : 'text-white' }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('blogList') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('blogList') ? 'active bg-primary' : 'text-white' }}">
                <i class="bi bi-journal-text me-2"></i> Blog Posts
            </a>
        </li>
    </ul>

    <hr style="border-color: rgba(255,255,255,0.1); margin: 20px 0;">

    <!-- Logout -->
    <div class="mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
</div>
