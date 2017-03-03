@extends('layouts.base')

@section('breadcrumb')
   <li class="breadcrumb-item">Herramientas</li>
	 <li class="breadcrumb-item">Presentaciones</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-tag"></i>
            <strong>Presentaciones de Productos</strong>
            <small>Listado</small>
            <a href="{{ route('product.presentations.create') }}" style="margin-top: 5px" class="btn btn-primary pull-right btn-sm"><span class="fa fa-plus"></span></a>
        </div>
        <div class="panel-body">
          {{ Form::open(['product.presentations.index', 'method' => 'get']) }}
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
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Presentaciones</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($presentations as $presentation)
                     <tr>
                         <td>{{ $presentation->name }}</td>
                         <td>{{ $presentation->description }}</td>
                         <td><a href="{{ $presentation->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i> Editar</a></td>
                     </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
                    <!--/.row-->
        <div class="panel-footer">
          {{ $presentations->links() }}
        </div>
      </div>
    </div>
	</div>
@stop


