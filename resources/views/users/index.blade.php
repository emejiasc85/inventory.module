@extends('layouts.base')

@section('breadcrumb')
	<li class="breadcrumb-item">Configuraciones</li>
  <li class="breadcrumb-item">Usuarios</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <i-fa class="fa-grid"></i-fa>
            <strong>Usuarios</strong>
            <small>Listado</small>
            <a href="{{ route('users.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Agregar usuario</a>
        </div>
        <div class="panel-body">
            {{ Form::model(Request::all(),['users.index', 'method' => 'get']) }}
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Buscar">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info"><i class="fa fa-search"></i>Buscar</button>
                        </span>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
            <div class="table-resposive">
              <table class="table col-sm-12">
                   <tr>
                       <th>Nombre</th>
                       <th>Correo</th>
                       <th>Usuario</th>
                       <th>Rol de Usuario</th>
                       <td colspan="2"></td>
                   </tr>
                   @foreach ($users as $user)
                       <tr>
                           <td>{{ $user->name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>{{ $user->username }}</td>
                           <td>{{ $user->role->name }}</td>
                           <td><a href="{{ $user->editUrl }}" class="btn btn-link "> <i class="fa fa-pencil text-success"></i>  Editar</a></td>
                           <td><a href="{{ $user->editPasswordUrl }}" class="btn btn-link"> <i class="fa fa-key text-primary"></i>  Contraseña</a></td>
                       </tr>
                   @endforeach
              </table>
            </div>
        </div>
        <div class="panel-footer">
          {{ $users->links() }}
        </div>
      </div>
    </div>
	</div>
@stop
