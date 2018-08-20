@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Resoluciones</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Resoluciones</strong>
                <small>Listado</small>
                <a href="{{ route('resolutions.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Agregar resolición</a>
            </div>
            <div class="panel-body">
                <div class="table-resposive">
                    <table class="table col-sm-12">
                        <tr>
                            <th>Comercio</th>
                            <th>Resoluciones</th>
                            <th>Fecha</th>
                            <th>Rango</th>
                            <th>Estado</th>
                            <td>Acciones</td>
                        </tr>
                        @foreach ($resolutions as $resolution)
                        <tr>
                            <td>{{ $resolution->commerce->name }}</td>
                            <td>{{ $resolution->resolution }}</td>
                            <td>{{ $resolution->date->format('d-m-Y') }}</td>
                            <td>{{ $resolution->from }} al {{ $resolution->to }} </td>
                            <td><span {!! Html::classes(['fa fa-square', 'text-success' => $resolution->status, 'text-muted' => !$resolution->status]) !!}></span></td>
                            <td>
                                <a href="{{ $resolution->editUrl }}" class="btn btn-link btn-sm "> <i class="fa fa-pencil text-success"></i>  Editar</a>
                                <a href="{{ $resolution->reportUrl }}" class="btn btn-link btn-sm "> <i class="fa fa-download text-info"></i>  Reporte</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                {{ $resolutions->links() }}
            </div>
        </div>
    </div>
</div>
@stop
