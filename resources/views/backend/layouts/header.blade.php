<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Admin Top Navbar -->
<nav class="navbar sticky-top shadow-sm d-flex flex-wrap align-items-center justify-content-between" 
     style="height:56px; background-color:#1f1f2e; padding:0 1rem; z-index:1030;">

    <!-- Brand / Logo -->
    <a class="navbar-brand d-flex align-items-center fs-6 fw-semibold" href="{{ route('dashboard') }}"
       style="color:#fff; padding:8px 12px; border-radius:4px; background-color: rgba(255,255,255,0.05); transition:all 0.3s; font-size:1rem;">
        <i class="bi bi-speedometer2 me-2" style="color:#0d6efd; font-size:1rem;"></i>
        SkinCare Bulletin
        @if(Auth::check())
            <span class="ms-2 text-light" style="font-size:0.85rem; opacity:0.8;">
                ({{ Auth::user()->name }})
            </span>
        @endif
    </a>

    <!-- Toggle Button for small screens -->
    <button class="btn btn-outline-light d-md-none" type="button" 
            onclick="document.getElementById('navbar-right').classList.toggle('d-none')"
            style="padding:4px 8px; border-radius:4px;">
        <i class="bi bi-list"></i>
    </button>

    <!-- Right Section -->
    <ul id="navbar-right" class="navbar-nav d-flex align-items-center mb-0 d-none d-md-flex" 
        style="list-style:none; margin:0; padding:0;">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" 
                        style="display:flex; align-items:center; gap:6px; padding:6px 12px; 
                               border:none; border-radius:4px; background-color:rgba(255,255,255,0.05); 
                               color:#fff; font-size:14px; cursor:pointer; transition:all 0.3s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.15)'" 
                        onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</nav>

<!-- Optional JavaScript for smaller screens toggle -->
<script>
    // Hide navbar-right initially on small screens
    if(window.innerWidth < 768){
        document.getElementById('navbar-right').classList.add('d-none');
    }
    window.addEventListener('resize', function(){
        if(window.innerWidth >= 768){
            document.getElementById('navbar-right').classList.remove('d-none');
        } else {
            document.getElementById('navbar-right').classList.add('d-none');
        }
    });
</script>
