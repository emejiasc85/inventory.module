@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Herramientas</li>
<li class="breadcrumb-item"><a href="{{ route('product_series.index') }}">Series</a></li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Series de  Productos</strong>
                <small>Listado</small>
                <a href="{{ route('product_series.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Agregar</a>
            </div>
            <div class="panel-body">
                {{ Form::model(Request::all(),['product_series.index', 'method' => 'get']) }}
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
                            <th>ID</th>
                            <th>Serie</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach ($series as $serie)
                        <tr>
                            <td>{{ $serie->id }}</td>
                            <td>{{ $serie->name }}</td>
                            <td>{{ $serie->description }}</td>
                            <td><a href="{{ $serie->editUrl }}" class="btn btn-link "> <i class="fa fa-pencil text-success"></i>  Editar</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                {{ $series->links() }}
            </div>
        </div>
    </div>
</div>
@stop
