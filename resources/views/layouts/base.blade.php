<!--
 * GenesisUI - Bootstrap 4 Admin Template
 * @version v1.7.1
 * @link https://genesisui.com
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license Commercial
 -->
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Emejias - Modulo de Inventario">
    <meta name="author" content="Enrique Mejias">
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'emejias') }}</title>

    <!-- Icons -->
    {!! Html::style('assets/css/font-awesome.min.css') !!}
    {!! Html::style('assets/css/simple-line-icons.css') !!}

    <!-- Premium Icons -->
    {!! Html::style('assets/css/glyphicons.css') !!}
    {!! Html::style('assets/css/glyphicons-filetypes.css') !!}
    {!! Html::style('assets/css/glyphicons-social.css') !!}

    <!-- Main styles for this application -->
    {!! Html::style('assets/css/style.css') !!}

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-compact'				- Compact Sidebar Navigation (Only icons)

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Footer options
1. 'footer-fixed'						- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden ">

    @include('layouts.partials.header')

    <div class="app-body">
        @include('layouts.partials.main-menu')
        <!-- Main content -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb mb-0">
                @yield('breadcrumb')
            </ol>

            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.conainer-fluid -->
        </main>

    </div>

    @include('layouts.partials.footer')



    <!-- Bootstrap and necessary plugins -->
    {!! Html::script('assets/js/libs/jquery.min.js') !!}
    {!! Html::script('assets/js/libs/tether.min.js') !!}
    {!! Html::script('assets/js/libs/bootstrap.min.js') !!}
    {!! Html::script('assets/js/libs/pace.min.js') !!}
    <!-- GenesisUI main scripts -->
    {!! Html::script('assets/js/app.js') !!}

    <!-- Plugins and scripts required by this views -->
    {!! Html::script('assets/js/libs/toastr.min.js') !!}
    {!! Html::script('assets/js/libs/gauge.min.js') !!}
    {!! Html::script('assets/js/libs/moment.min.js') !!}
    {!! Html::script('assets/js/libs/daterangepicker.js') !!}

    <!-- Custom scripts required by this view -->

</body>

</html>