<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Admin Top Navbar -->
<nav class="navbar sticky-top shadow-sm" 
     style="height: 56px; background-color: #1f1f2e; padding: 0 1rem; display: flex; align-items: center; justify-content: space-between; z-index: 1030;">

    <!-- Brand / Logo -->
    <a class="navbar-brand d-flex align-items-center fs-6 fw-semibold" href="{{ route('dashboard') }}"
       style="color: #fff; padding: 8px 12px; border-radius: 4px; background-color: rgba(255,255,255,0.05); transition: all 0.3s;">
        <i class="bi bi-speedometer2 me-2" style="color: #0d6efd; font-size: 1rem;"></i>
        Admin Panel
    </a>

    <!-- Right Section -->
    <ul class="navbar-nav d-flex align-items-center mb-0" style="list-style: none; display: flex; margin: 0; padding: 0;">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" 
                        style="display: flex; align-items: center; gap: 6px; padding: 6px 12px; 
                               border: none; border-radius: 4px; background-color: rgba(255,255,255,0.05); 
                               color: #fff; font-size: 14px; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.15)'" 
                        onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
