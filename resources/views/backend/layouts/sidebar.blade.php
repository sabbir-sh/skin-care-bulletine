<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<body style="margin:0; font-family: 'Segoe UI', sans-serif; background-color:#f8f9fa; color:#212529;">

    <!-- Sidebar Toggle Button for small screens -->
    <button class="btn btn-dark d-md-none position-fixed" 
            style="top:10px; left:10px; z-index:1050;" 
            onclick="document.getElementById('sidebar').classList.toggle('d-none')">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="d-flex flex-column position-fixed vh-100"
         style="width:250px; background: linear-gradient(180deg, #282836 0%, #12121b 100%); padding:1rem; z-index:1040;">
        


        <!-- Navigation -->
<ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" 
           class="nav-link text-white d-flex align-items-center mb-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}"
           style="border-radius:6px; transition:0.3s;">
            <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('blog.list') }}" 
           class="nav-link text-white d-flex align-items-center mb-2 {{ request()->routeIs('blog.list') ? 'active' : '' }}"
           style="border-radius:6px; transition:0.3s;">
            <i class="bi bi-journal-text me-2"></i> Blog Posts
        </a>
    </li>
</ul>


    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Optional: Hide sidebar by default on small screens
        if(window.innerWidth < 768){
            document.getElementById('sidebar').classList.add('d-none');
        }
        window.addEventListener('resize', function(){
            if(window.innerWidth >= 768){
                document.getElementById('sidebar').classList.remove('d-none');
            } else {
                document.getElementById('sidebar').classList.add('d-none');
            }
        });
    </script>
</body>
