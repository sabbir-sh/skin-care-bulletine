<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container" style="background-color: #1f1f2e; min-height: 100vh;">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="card-title text-center mb-4">Login</h4>

                    <!-- Session Status -->
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="remember_me" 
                                name="remember" 
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <label class="form-check-label text-white" for="remember_me">Remember me</label>
                        </div>

                        <!-- Forgot Password & Submit -->
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">Forgot your password?</a>
                            @endif --}}
                            <button type="submit" class="btn btn-primary">Log in</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        background-color: #1f1f2e;
        color: #fff;
        font-family: 'Segoe UI', sans-serif;
    }

    .card {
        background-color: #282836;
        color: #fff;
    }

    .form-label, .form-check-label {
        color: #fff;
    }

    .form-control {
        background-color: #3a3a4b;
        color: #fff;
        border: 1px solid #555;
    }

    .form-control:focus {
        background-color: #3a3a4b;
        color: #fff;
        border-color: #0d6efd;
        box-shadow: none;
    }
</style>
