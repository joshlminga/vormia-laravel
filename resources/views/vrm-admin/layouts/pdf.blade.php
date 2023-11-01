<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $data->site_name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="no index, no follow">

    <link href="{{ $data->base_url }}/vrm-content/plugins/dompdf/pdf.min.css" rel="stylesheet" />
</head>

<body class="pdf-body">
    <div class="pdf-center">
        <img src="{{ $data->base_url }}/vrm-content/themes/bluelime/blue-line-logo.png" class="pdf-logo" />
    </div>
    <div class="pdf-center pdf-header">
        {{-- <h2>BLUELIME LIMITED</h2> --}}
        {{-- <h3>Panari Hotel, Nairobi, Kenya</h3> --}}
        {{-- <h4>9th – 12th October 2023 </h4> --}}

        <p class="">Clearing and Fowarding Partner</p>
    </div>

    {{-- Invoice Header --}}
    @yield('pdf_header')

    <!-- Main Page -->
    @yield('content')
    <!-- End Main Page -->
</body>

</html>
