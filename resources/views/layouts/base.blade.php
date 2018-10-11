
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="emejias.com">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api-token" content="{{ auth()->user()->api_token }}">
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
        <title>{{ config('app.name', 'emejias.com') }}</title>
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/jquery.mmenu.css') !!}
        {!! Html::style('css/simple-line-icons.css') !!}
        {!! Html::style('css/simple-line-icons.css') !!}
        {!! Html::style('plugins/jquery-ui/css/jquery-ui-1.10.4.min.css') !!}
        {!! Html::style('css/font-awesome.min.css') !!}
        {!! Html::style('css/style.css') !!}
        {!! Html::style('css/add-ons.css') !!}
        {!! Html::style('plugins/select2/css/select2.css') !!}
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
                ]); ?>
        </script>

        @yield('styles')
    </head>
    <style>
        .btn-print{
            position: fixed;
            bottom  : 160px;
            right   : 291px;
        }
        .jqstooltip {
          -webkit-box-sizing: content-box;
          -moz-box-sizing: content-box;
          box-sizing: content-box;
        }
    </style>

    <!-- BODY options, add following classes to body to change options

        1. 'sidebar-minified'     - Switch sidebar to minified version (width 50px)
        2. 'sidebar-hidden'       - Hide sidebar
        3. 'rtl'                  - Switch to Right to Left Mode
        4. 'container'            - Boxed layout
        5. 'static-sidebar'       - Static Sidebar
        6. 'static-header'        - Static Header
    -->

    <body class="sidebar-hidden" >
        <!-- start: Header -->
        @include('layouts.partials.header')
        <!-- end: Header -->
        <!-- start: Main Menu -->
        @include('layouts.partials.main-menu')
        <!-- end: Main Menu -->
        <!-- start: Content -->
        <div class="main" id="app">
            {!! Alert::render('templates.alert') !!}
            <ol class="breadcrumb hidden-print">
                <li><a href="{{ url('/') }}">Inicio</a></li>
                @yield('breadcrumb')
            </ol>
            @yield('content')
        </div>
        @yield('modals')
        <!-- end: Content -->

        {{-- <footer>
                @include('layouts.partials.footer')
        </footer> --}}
        <script src="{{ mix('/js/app.js') }}"></script>
        {!! Html::script('js/jquery-3.1.0.min.js') !!}
        {!! Html::script('js/jquery-migrate-1.4.1.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        {!! Html::script('plugins/jquery-ui/js/jquery-ui-1.10.4.min.js') !!}

        <!-- theme scripts -->
        {!! Html::script('plugins/pace/pace.min.js') !!}
        {!! Html::script('js/jquery.mmenu.min.js') !!}
        {!! Html::script('js/core.min.js') !!}
        {!! Html::script('plugins/jquery-cookie/jquery.cookie.min.js') !!}
        {!! Html::script('js/demo.min.js') !!}
        {!! Html::script('plugins/select2/js/select2.min.js') !!}
        <!-- end: JavaScript-->
        <script>
            /****
            * upload image
            */

            $(document).ready(function () {
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#blah').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#logo").change(function(){
                    readURL(this);
                });
                // body...
            });
            /****
            * remove alerts
            */
            $(document).ready(function() {
                $(".alert").fadeTo(7000, 0, function(){
                    $(this).alert('close')
                });
            }, 4000);

            $('select').select2();

        </script>

        @yield('scripts')

    </body>
</html>