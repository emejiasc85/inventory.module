@extends('layouts.base')

@section('breadcrumb')
	<li class="breadcrumb-item">Herramientas</li>
  <li class="breadcrumb-item"><a href="{{ route('product.groups.index') }}">Grupos</a></li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <i-fa class="fa-grid"></i-fa>
            <strong>Grupos de Productos</strong>
            <small>Listado</small>
            <a href="{{ route('product.groups.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span></a>
        </div>
        <div class="panel-body">
            {{ Form::open(['product.groups.index', 'method' => 'get']) }}
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
                       <th>Grupos</th>
                       <th>Descripción</th>
                       <th>Acciones</th>
                   </tr>
                   @foreach ($groups as $group)
                       <tr>
                           <td>{{ $group->name }}</td>
                           <td>{{ $group->description }}</td>
                           <td><a href="{{ $group->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i>  Editar</a></td>
                       </tr>
                   @endforeach
              </table>
            </div>
        </div>
        <div class="panel-footer">
          {{ $groups->links() }}
        </div>
      </div>
    </div>
	</div>
@stop


