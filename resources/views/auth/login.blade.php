
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="emejias">
    <link rel="shortcut icon" href="img/favicon.ico">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-style">
    <!-- Icons -->
    {!! Html::style('css/jquery.mmenu.css') !!}
    {!! Html::style('css/font-awesome.min.css') !!}
    {!! Html::style('css/simple-line-icons.css') !!}

    <!-- Custom styles for this template -->
    {!! Html::style('css/style.min.css') !!}
    {!! Html::style('css/add-ons.min.css') !!}

</head>

<body class="login">
    <div class="container">
        <div class="row">
                <div class="login-box col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="header">
                        Inventario
                    </div>
                    {!! Form::open(['route' => 'login']) !!}
                        <fieldset>
                            <div class="form-group first  {{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                                <div class="input-group col-sm-12">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="mail" name="email" class="form-control input-lg" id="username" placeholder="E-mail"/>
                                    @if ($errors->has('email'))
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    @endif
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block "><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group last {{ $errors->has('password') ? ' has-error has-feedback' : '' }}">
                                <div class="input-group col-sm-12">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Contraseña"/>
                                    @if ($errors->has('password'))
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    @endif
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block "><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary col-xs-12">Ingresar</button>
                            <div class="row">
                                <div class="col-xs-7">
                                    <a class="pull-left" href="{{ route('password.request') }}">Recuperar Contraseña</a>
                                </div><!--/col-->
                            </div><!--/row-->
                        </fieldset>
                    {!! Form::close() !!}
                </div>
        </div><!--/row-->
    </div>

    <!-- Bootstrap and necessary plugins -->

    {!! Html::script('js/jquery-3.1.0.min.js') !!}
    {!! Html::script('plugins/pace/pace.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}

</body>

</html>








