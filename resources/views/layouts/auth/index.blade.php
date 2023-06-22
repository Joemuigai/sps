<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta http-equiv="Content-Language" content="en">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="theme-color" content="#fff" />

    <meta name="keywords" content="">

    <meta name="description" content="">

    <meta name="author" content="Florid Inc. Developers">

    <meta name="robots" content="index, follow, noodp, noarchive" />

    <meta name="googlebot" content="index, follow, noodp, noarchive, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />

    <meta name="bingbot" content="index, follow, noodp, noarchive, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />

    <meta name="google" content="noimageindex" />

    <meta name="geo.region" content="Kenya" />

    <title>{{ $page_title }} : SPS || Strathmore Parking System</title>

    <link rel='dns-prefetch' href='//ajax.googleapis.com' />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />

    <link rel="icon" href="https://strathmore.edu/wp-content/uploads/2016/10/cropped-coatofarms-300x300.jpg" sizes="32x32" />

    <link rel="icon" href="https://strathmore.edu/wp-content/uploads/2016/10/cropped-coatofarms-300x300.jpg" sizes="192x192" />

    <link rel="apple-touch-icon" href="https://strathmore.edu/wp-content/uploads/2016/10/cropped-coatofarms-300x300.jpg" />

    <meta name="msapplication-TileImage" content="https://strathmore.edu/wp-content/uploads/2016/10/cropped-coatofarms-300x300.jpg" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/vendor.min.css') }}">

    @yield('css_scripts')

    <link rel="stylesheet" href="{{ asset('assets/css/facebook/app.min.css') }}">

</head>

<body class='pace-top'>

    <div id="app" class="app">


        @yield('content')

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top"data-toggle="scroll-to-top">
            <i class="fa fa-angle-up"></i>
        </a>

    </div>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    @yield('js_scripts')


</body>


</html>
