@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item">Configuraciones</li>
     <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuarios</a></li>
     <li class="breadcrumb-item active"><a href="{{ $user->editUrl }}"></a>{{ $user->name }}</li>
     <li class="breadcrumb-item active">Editar Contraseña</li>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2" >
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i>
                    <strong>{{ $user->name }}</strong>
                    <small>Editar Contraseña</small>
                </div>
                {!! Form::model($user, ['route' => ['users.password.update', $user], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Field::password('password', ['template' => 'templates.inline']) !!}
                            {!! Field::password('password_confirmation', ['template' => 'templates.inline']) !!}
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-pencil"></i>
                        Editar
                    </button>
                    <a href="{{ URL::previous() }}" class="btn btn-link text-danger">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </a>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@stop


