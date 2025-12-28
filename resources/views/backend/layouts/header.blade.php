<!-- Bootstrap CSS + Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .admin-navbar {
        height: 56px;
        background: #ffffff;
        padding: 0 1rem;
        z-index: 1030;
    }

    .admin-brand {
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 6px 10px;
        border-radius: 6px;
        background: rgba(255,255,255,0.06);
        transition: 0.3s;
        text-decoration: none;
        white-space: nowrap;
    }

    .admin-brand i {
        color: #0d6efd;
    }

    .admin-user {
        font-size: 0.8rem;
        opacity: 0.85;
    }

    .admin-btn {
        padding: 6px 14px;
        border-radius: 6px;
        background: rgba(255,255,255,0.08);
        border: none;
        color: #fff;
        font-size: 14px;
        transition: 0.3s;
    }

    .admin-btn:hover {
        background: #dc3545;
    }

    /* ===== MOBILE FIX ===== */
    @media (max-width: 767px) {

        .admin-user {
            display: none;
        }

        .admin-brand span {
            display: none;
        }

        /* Collapse menu full width & top aligned */
        #adminMenu {
            position: absolute;
            top: 56px;
            left: 0;
            width: 100%;
            background: #0a0a0a;
            padding: 10px 15px;
        }

        #adminMenu .navbar-nav {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 10px;
        }

        .dropdown-menu {
            position: static !important;
            width: 100%;
        }
    }
</style>

<nav class="navbar navbar-dark sticky-top shadow-sm admin-navbar">

    <!-- LEFT -->
    <div class="d-flex align-items-center gap-2">

        <!-- Mobile toggle -->
        <button class="btn btn-outline-light d-md-none"
                data-bs-toggle="collapse"
                data-bs-target="#adminMenu">
            <i class="bi bi-list"></i>
        </button>

        <a href="{{ route('dashboard') }}" class="admin-brand d-flex align-items-center">
            <i class="bi bi-speedometer2 me-2"></i>
            <span>রক্তদানই জীবনের সেরা উপহার</span>

            @if(Auth::check())
                <span class="ms-2 admin-user">({{ Auth::user()->name }})</span>
            @endif
        </a>
    </div>

    <!-- RIGHT -->
    <div class="collapse d-md-block" id="adminMenu">
        <ul class="navbar-nav ms-md-auto flex-row align-items-center gap-2">

            <li class="nav-item dropdown w-100 w-md-auto">
                <a class="btn admin-btn dropdown-toggle w-100 w-md-auto text-start"
                   href="#"
                   role="button"
                   data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i> Account
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li class="dropdown-item text-muted small">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>

            </li>

        </ul>
    </div>

</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
