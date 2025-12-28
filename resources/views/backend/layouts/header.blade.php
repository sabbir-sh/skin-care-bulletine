<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .admin-navbar {
        height: 56px;
        background: linear-gradient(135deg, #0a0a0a, #0a0a0a);
        padding: 0 1rem;
        z-index: 1030;
    }

    .admin-brand {
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        padding: 6px 12px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.06);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .admin-brand:hover {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
    }

    .admin-brand i {
        color: #0d6efd;
        font-size: 1.1rem;
    }

    .admin-user {
        font-size: 0.85rem;
        opacity: 0.85;
    }

    .admin-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 6px;
        border: none;
        background: rgba(255, 255, 255, 0.06);
        color: #fff;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .admin-btn:hover {
        background: #dc3545;
        color: #fff;
    }

    .mobile-toggle {
        border-radius: 6px;
        padding: 4px 10px;
    }
</style>

<nav class="navbar sticky-top shadow-sm admin-navbar d-flex align-items-center justify-content-between">

    <!-- Logo / Brand -->
    <a href="{{ route('dashboard') }}" class="admin-brand d-flex align-items-center">
        <i class="bi bi-speedometer2 me-2"></i>
        SkinCare Bulletin
        @if(Auth::check())
            <span class="ms-2 admin-user">({{ Auth::user()->name }})</span>
        @endif
    </a>

    <!-- Mobile Toggle -->
    <button class="btn btn-outline-light d-md-none mobile-toggle"
        onclick="document.getElementById('navbar-right').classList.toggle('d-none')">
        <i class="bi bi-list"></i>
    </button>

    <!-- Right Menu -->
    <ul id="navbar-right" class="navbar-nav d-flex align-items-center mb-0 d-none d-md-flex"
        style="list-style:none;">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="admin-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</nav>

<script>
    if (window.innerWidth < 768) {
        document.getElementById('navbar-right').classList.add('d-none');
    }
    window.addEventListener('resize', function () {
        const nav = document.getElementById('navbar-right');
        window.innerWidth >= 768 ? nav.classList.remove('d-none') : nav.classList.add('d-none');
    });
</script>
