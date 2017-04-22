@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Configuraciones</li>
     <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuarios</a></li>
     <li class="breadcrumb-item active">{{ $user->name }}</li>
	 <li class="breadcrumb-item active">Editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2" >
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i>
                    <strong>{{ $user->name }}</strong>
                    <small>Editar</small>
                    <a href="{{ $user->editPasswordUrl }}" class="btn btn-default btn-sm  pull-right" style="margin-top: 5px">
                        <span class=" text-success fa fa-key"></span> Editar Contraseña
                    </a>
                </div>
				{!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Field::text('name', ['template' => 'templates.inline']) !!}
                            {!! Field::email('email', ['template' => 'templates.inline']) !!}
                            {!! Field::text('username', ['template' => 'templates.inline']) !!}
                            {!! Field::select('role_id', $roles, null, ['template' => 'templates.inline']) !!}
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


