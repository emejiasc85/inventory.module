@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Configuraciones</li>
<li class="breadcrumb-item">Comerciones</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="icon-badge"></i>
                <strong>Comerciones</strong>
                <small>Listado</small>
                <a href="{{ route('commerces.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Agregar Comercio</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Comercio</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Nit</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commerces as $commerce)
                            <tr>
                                <td>
                                    @if ($commerce->logo_path)
                                    <img src="{{  route('commerce.logo', $commerce) }}" alt="" class="img-rounded" width="50">
                                    @else
                                    <img src="{{ asset('img/picture.svg') }}" alt="" class="img-rounded" width="30">
                                    @endif
                                </td>
                                <td>{{ $commerce->name }}</td>
                                <td>{{ $commerce->address }}</td>
                                <td>{{ $commerce->phone }}</td>
                                <td>{{ $commerce->nit }}</td>
                                <td><a href="{{ $commerce->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i> Editar</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
</div>
@stop


