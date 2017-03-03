@extends('layouts.base')

@section('breadcrumb')
  <li class="breadcrumb-item">Herramientas</li>
  <li class="breadcrumb-item">Marcas</li>
@stop

@section('content')
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="icon-badge"></i>
          <strong>Marcas</strong>
          <small>Listado</small>
          <a href="{{ route('makes.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span></a>
        </div>
        <div class="panel-body">
          {{ Form::open(['makes.index', 'method' => 'get']) }}
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
                  <th></th>
                  <th>Marca</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($makes as $make)
                  <tr>
                    <td>
                    @if ($make->logo_path)
                      <img src="{{  route('makes.logo', $make) }}" alt="" class="img-rounded" width="50">
                    @else
                      <img src="assets/img/picture.svg" alt="" class="img-rounded" width="30">
                    @endif
                    </td>
                    <td>{{ $make->name }}</td>
                    <td><a href="{{ $make->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i> Editar</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="panel-footer">
          {{ $makes->links() }}
        </div>
      </div>
    </div>
  </div>
@stop


