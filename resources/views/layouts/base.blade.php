
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="emejias.com">
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
        <title>{{ config('app.name', 'emejias.com') }}</title>
        <!-- Bootstrap core CSS -->
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/jquery.mmenu.css') !!}
        {!! Html::style('css/simple-line-icons.css') !!}
        {!! Html::style('css/simple-line-icons.css') !!}
        {!! Html::style('plugins/jquery-ui/css/jquery-ui-1.10.4.min.css') !!}
        <!-- page css files -->
        {!! Html::style('css/font-awesome.min.css') !!}
        <!-- Custom styles for this template -->
        {!! Html::style('css/style.min.css') !!}
        {!! Html::style('css/add-ons.min.css') !!}
        @yield('styles')
    </head>

    <!-- BODY options, add following classes to body to change options

        1. 'sidebar-minified'     - Switch sidebar to minified version (width 50px)
        2. 'sidebar-hidden'       - Hide sidebar
        3. 'rtl'                  - Switch to Right to Left Mode
        4. 'container'            - Boxed layout
        5. 'static-sidebar'       - Static Sidebar
        6. 'static-header'        - Static Header
    -->

    <body >

        <!-- start: Layout Settings / remove this div from your project
        <div id="theme-settings" class="hidden-sm hidden-xs">
            <div id="open-close">
                <i class="fa fa-wrench"></i>
            </div>
            <h4>Options</h4>
            <ul id="options">
                <li>
                    <label class="custom-checkbox-item pull-left">
                        <input id="sm" class="custom-checkbox" type="checkbox"/>
                        <span class="custom-checkbox-mark"></span>
                    </label>
                    <span class="desc">Sidebar Minified</span>
                </li>
                <li>
                    <label class="custom-checkbox-item pull-left">
                        <input id="sh" class="custom-checkbox" type="checkbox"/>
                        <span class="custom-checkbox-mark"></span>
                    </label>
                    <span class="desc">Sidebar Hidden</span>
                </li>
                <li>
                    <label class="custom-checkbox-item pull-left">
                        <input id="rtl" class="custom-checkbox" type="checkbox"/>
                        <span class="custom-checkbox-mark"></span>
                    </label>
                    <span class="desc">Right to Left</span>
                </li>
                <li>
                    <label class="custom-checkbox-item pull-left">
                        <input id="bl" class="custom-checkbox" type="checkbox"/>
                        <span class="custom-checkbox-mark"></span>
                    </label>
                    <span class="desc">Boxed Layout</span>
                </li>
                <li>
                    <label class="custom-checkbox-item pull-left">
                        <input id="ss" class="custom-checkbox" type="checkbox"/>
                        <span class="custom-checkbox-mark"></span>
                    </label>
                    <span class="desc">Static Sidebar</span>
                </li>
                <li>
                    <label class="custom-checkbox-item pull-left">
                        <input id="she" class="custom-checkbox" type="checkbox"/>
                        <span class="custom-checkbox-mark"></span>
                    </label>
                    <span class="desc">Static Header</span>
                </li>

            </ul>
        </div>
       end: Layout Settings -->

        <!-- start: Header -->
        @include('layouts.partials.header')
        <!-- end: Header -->

        <!-- start: Main Menu -->
        @include('layouts.partials.main-menu')
        <!-- end: Main Menu -->

        <!-- start: Content -->
        <div class="main">
            {!! Alert::render() !!}
            <ol class="breadcrumb hidden-print">
                <li><a href="{{ url('/') }}">Inicio</a></li>
                @yield('breadcrumb')
            </ol>
            @yield('content')
        </div>

        @yield('modals')
        <!-- end: Content -->

        <!--
        <footer>
        </footer>
        -->
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
        </script>
        @yield('scripts')

    </body>
</html>