<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="keywords" content="{{getConfigTableData()->keywords}}" />
    <meta name="author" content="Donatepur" />
    <!-- Page Title -->
    <title>{{getConfigTableData()->title}}</title>
    <!-- Favicon and Touch Icons -->
    <link href="{{ asset(getConfigTableData()->favicon) }}" rel="shortcut icon" type="image/png">
    {{-- <link href="{{ asset('/images/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('/images/apple-touch-icon-72x72.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ asset('/images/apple-touch-icon-114x114.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ asset('/images/apple-touch-icon-144x144.png') }}" rel="apple-touch-icon" sizes="144x144">
    <!-- Stylesheet --> --}}
    <!-- Stylesheet -->
    <link href="{{ asset('/frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/frontend/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/frontend/css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/frontend/css/css-plugin-collections.css') }}" rel="stylesheet" />
    <!-- CSS | menuzord megamenu skins -->
    <link id="menuzord-menu-skins" href="{{ asset('/frontend/css/menuzord-skins/menuzord-boxed.css') }}"
        rel="stylesheet" />
    <!-- CSS | Main style file -->
    <link href="{{ asset('/frontend/css/style-main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/frontend/css/custom.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <link href="{{ asset('/frontend/css/preloader.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="{{ asset('/frontend/css/custom-bootstrap-margin-padding.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="{{ asset('/frontend/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="css/style.css')}}" rel="stylesheet" type="text/css"> -->
    <!-- Revolution Slider 5.x CSS settings -->
    <link href="{{ asset('/frontend/js/revolution-slider/css/settings.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/frontend/js/revolution-slider/css/layers.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/frontend/js/revolution-slider/css/navigation.css') }}" rel="stylesheet" type="text/css" />
    <!-- CSS | Theme Color -->
    <link href="{{ asset('/frontend/css/colors/theme-skin-blue-gary.css') }}" rel="stylesheet" type="text/css">
    <!-- external javascripts -->
    <script src="{{ asset('/frontend/js/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/bootstrap.min.js') }}"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="{{ asset('/frontend/js/jquery-plugin-collection.js') }}"></script>
    <!-- Revolution Slider 5.x SCRIPTS -->

    <script src="{{ asset('frontend/js/revolution-slider/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution-slider/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    @yield('header')

</head>
