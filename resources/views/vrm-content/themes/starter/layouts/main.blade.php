<!doctype html>
<html lang="en" class="pxp-root">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Global Header -->
    @include("$theme_dir.includes.global._head")
    <!-- End Global Header -->

    <!-- Main Header -->
    @include("$theme_dir.includes.head")
    <!-- End Main Header -->

    <!-- Sweetalert2 -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <!-- Custom Css-->
    <link href='{{ asset("$theme_assets/custom/css/style.min.css") }}?v={{ time() }}' id="customcss-style"
        rel="stylesheet" type="text/css" />

</head>

<body>


    <main class="main">

        {{-- Content --}}
        @yield('content')

    </main>

    <!-- Global Footer -->
    @include("$theme_dir.includes.global._footer")
    <!-- End Global Footer -->

    <!-- Main Footer -->
    @include("$theme_dir.includes.footer")
    <!-- End Main Footer -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset($theme_assets) }}/custom/js/main-custom.js?v={{ time() }}"></script>

</body>

</html>
