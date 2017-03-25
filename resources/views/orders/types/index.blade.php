@extends('layouts.base')

@section('breadcrumb')
  <li class="breadcrumb-item">Herramientas</li>
  <li class="breadcrumb-item">Ordenes</li>
  <li class="breadcrumb-item">Tipos</li>
@stop

@section('content')
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="icon-badge"></i>
          <strong>Tipos de Ordenes</strong>
          <small>Listado</small>
          <a href="{{ route('orders.type.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span></a>
        </div>
        <div class="panel-body">
          {{ Form::open(['orders.type.index', 'method' => 'get']) }}
            <div class="form-group">
            <div class="">
              <div class="input-group">
                <input type="text" id="name" name="name" class="form-control" placeholder="Buscar marca">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Buscar</button>
                </span>
              </div>
              </div>
            </div>
          {{ Form::close() }}
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Tipo</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($types as $type)
                  <tr>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->description }}</td>
                    <td><a href="{{ $type->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i> Editar</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="panel-footer">
          {{ $types->links() }}
        </div>
      </div>
    </div>
  </div>
@stop


