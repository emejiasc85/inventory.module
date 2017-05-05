@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Herramientas</li>
<li class="breadcrumb-item">Unidades de Medidas</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="icon-chemistry"></i>
                <strong>Unidades de Medidas</strong>
                <small>Listado</small>
                <a href="{{ route('unit.measures.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span></a>
            </div>
            <div class="panel-body">
                {{ Form::model(Request::all(),['unit.measures.index', 'method' => 'get']) }}
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Buscar marca">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>Buscar</button>
                            </span>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <div class="table responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Unidad</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach ($units as $unit)
                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->name }}</td>
                            <td><a href="{{ $unit->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i> Editar</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                {{ $units->links() }}
            </div>
        </div>

    </div>
</div>
@stop


