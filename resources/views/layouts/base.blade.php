
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
        {!! Html::style('plugins/jquery-ui/css/jquery-ui-1.10.4.min.css') !!}
        {!! Html::style('css/font-awesome.min.css') !!}
        {!! Html::style('css/style.css') !!}
        {!! Html::style('css/add-ons.css') !!}
        {!! Html::style('css/tooltip.css') !!}
        {!! Html::style('plugins/select2/css/select2.css') !!}
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
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
    <body class="sidebar-hidden" >
        @include('layouts.partials.header')
        @include('layouts.partials.main-menu')
        <div class="main" id="app">
            {!! Alert::render('templates.alert') !!}
            <ol class="breadcrumb hidden-print">
                <li><a href="{{ url('/') }}">Inicio</a></li>
                @yield('breadcrumb')
            </ol>
            @yield('content')
        </div>
        @yield('modals')
        {{-- <footer>
                @include('layouts.partials.footer')
        </footer> --}}
        <script src="{{ mix('/js/app.js') }}"></script>

        <!-- theme scripts -->
        {!! Html::script('js/jquery-migrate-1.4.1.min.js') !!}
        {!! Html::script('js/jquery.mmenu.min.js') !!}
        {!! Html::script('js/core.min.js') !!}
        {!! Html::script('plugins/jquery-cookie/jquery.cookie.min.js') !!}
        <!-- end: JavaScript-->
        <script>
            /****
            * remove alerts
            */
            $(document).ready(function() {
                $(".alert").fadeTo(7000, 0, function(){
                    $(this).alert('close')
                });
            }, 4000);

        </script>

        @yield('scripts')

    </body>
</html>