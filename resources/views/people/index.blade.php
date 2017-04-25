@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('product.groups.index') }}">Personas</a></li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Personas</strong>
                <small>Listado</small>
                <a href="{{ route('people.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Agregar Persona</a>
            </div>
            <div class="panel-body">
                {{ Form::open(['people.index', 'method' => 'get']) }}
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
                            <th>Nit</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th></th>
                        </tr>
                        @foreach ($people as $person)
                        <tr>
                            <td>{{ $person->nit }}</td>
                            <td>{{ $person->name}}</td>
                            <td>{{ $person->address}}</td>
                            <td>{{ $person->email}}</td>
                            <td>{{ $person->phone}}</td>
                            <td><a href="{{ $person->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i>  Editar</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-footer">
            {{ $people->links() }}
            </div>
        </div>
    </div>
</div>
@stop


