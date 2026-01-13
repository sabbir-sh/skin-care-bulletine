<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'রক্তদানই জীবনের সেরা উপহার')</title>

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Toastr CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    {{-- Toastr Color Override --}}
    <style>
        /* SUCCESS (Green) */
        .toast-success {
            background-color: #198754 !important;
            color: #fff !important;
        }

        /* ERROR (Red) */
        .toast-error {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        /* WARNING (Yellow) */
        .toast-warning {
            background-color: #ffc107 !important;
            color: #000 !important;
        }

        /* INFO (Blue) */
        .toast-info {
            background-color: #0d6efd !important;
            color: #fff !important;
        }

        .toast-close-button {
            color: #fff !important;
            opacity: 0.9;
        }
    </style>
</head>

<body>

    @include('backend.layouts.header')

    <div class="container-fluid">
        <div class="row">
            @include('backend.layouts.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    @include('backend.layouts.footer')

    {{-- jQuery (Required) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Toastr JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- Toastr Global Config --}}
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3000,
            extendedTimeOut: 1000,
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
    </script>

    {{-- Session Flash Messages --}}
    @if(session('success'))
        <script>toastr.success(@json(session('success')));</script>
    @endif

    @if(session('error'))
        <script>toastr.error(@json(session('error')));</script>
    @endif

    @if(session('warning'))
        <script>toastr.warning(@json(session('warning')));</script>
    @endif

    @if(session('info'))
        <script>toastr.info(@json(session('info')));</script>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error(@json($error));
            @endforeach
        </script>
    @endif

    @stack('scripts')

</body>

</html>