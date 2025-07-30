<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap 5 CSS --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" rel="stylesheet"> --}}

    {{-- Tempus Dominus Styles --}}
    {{-- <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css"> --}}

    @vite(['resources/css/main.css', 'resources/js/app.js'])
    @yield('styles')

    <title>@yield('title', 'App')</title>
</head>

<body>
    <!-- Header/Navbar -->
    @include('layouts.header')

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Modals -->
    @include('modals.delete_confirm')
    @include('modals.change_status')

    <!-- Main Content -->
    <div class="main-content position-relative ">
        @yield('content')
    </div>

    {{-- Bootstrap 5 Bundle --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script> --}}

    {{-- Popper JS --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> --}}

    {{-- Tempus Dominus JavaScript --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/js/tempus-dominus.min.js"></script> --}}

    {{-- Font Awesome --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
        integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    @yield('scripts')
</body>

</html>
