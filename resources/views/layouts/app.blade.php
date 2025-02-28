<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MesaYa - @yield('title')</title>

    {{-- Vite para importar Bootstrap --}}
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <!-- Font Awesome (Íconos) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="{{ asset('../../img/logo.png') }}" type="image/x-icon">
</head>

<body>

    @include('partials.header')

    <main class="{{ request()->routeIs('nosotros') ? 'p-0' : 'py-4' }}">
        @yield('content')
    </main>

    @include('partials.footer')


    <!-- Toast de Notificaciones -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        @if(session('success'))
            <div id="toastSuccess" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div id="toastError" class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>

    <script>
        // Ocultar los toasts después de 5 segundos
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                let successToast = document.getElementById("toastSuccess");
                let errorToast = document.getElementById("toastError");

                if (successToast) {
                    let toast = new bootstrap.Toast(successToast);
                    toast.hide();
                }

                if (errorToast) {
                    let toast = new bootstrap.Toast(errorToast);
                    toast.hide();
                }
            }, 5000);
        });
    </script>

</body>
</html>
