
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Real Bootstrap 4 Admin Template">
    <meta name="author" content="emejias">
    <link rel="shortcut icon" href="assets/img/favicon.ico">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Icons -->
    {!! Html::style('assets/css/font-awesome.min.css') !!}
    {!! Html::style('assets/css/simple-line-icons.css') !!}

    <!-- Main styles for this application -->
    {!! Html::style('assets/css/style.css') !!}

</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-group mb-0">
                    <div class="card p-2">
                        <div class="card-block">
                            <h1>Inventario</h1>
                            <p class="text-muted">Ingresa a tu cuenta</p>
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="controls">
                                    <div class="input-prepend input-group   {{ $errors->has('email') ? ' has-danger has-feedback' : '' }}">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        <input  name="email" class="form-control  {{ $errors->has('email') ? ' form-control-danger' : '' }}" size="16" type="email required">
                                    </div>
                                    @if ($errors->has('email'))
                                        <p class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                    <div class="input-prepend input-group {{ $errors->has('password') ? ' has-danger has-feedback' : '' }}">
                                        <span class="input-group-addon"><i class="icon-lock"></i></span>
                                        <input  class="form-control {{ $errors->has('password') ? ' form-control-danger' : '' }}" size="16" type="password" name="password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <p class="help-block text-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary px-2">Ingresar</button>
                                </div>
                            </form>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="btn btn-link px-0">recuperar contraseña</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and necessary plugins -->

    {!! Html::script('assets/js/libs/jquery.min.js') !!}
    {!! Html::script('assets/js/libs/tether.min.js') !!}
    {!! Html::script('assets/js/libs/bootstrap.min.js') !!}

</body>

</html>








