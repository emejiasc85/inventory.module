@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Existencias</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-left">
                    <i class="fa fa-truck"></i>
                    <strong>Agrupado por pedido</strong>
                    <small>Listado</small>
                </div>
                <div class="pull-right">
                    <a href="{{ route('stocks.index', Request::all()) }}" class="btn btn-primary btn-sm"><i class="fa fa-cubes"></i> Agrupar por producto</a>
                    <a href="{{ route('stocks.byOrder.download', Request::all()) }}" title="Descargar a excel" class="btn btn-default btn-sm"><i class="fa fa-download"></i></a>
                </div>
            </div>
            <div class="panel-body">
                    <div class="row">
                        @include('stocks.partials.search')
                    </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            @include('stocks.partials.tableByOrder')
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
            {{ $stocks->links() }}
            </div>
        </div>
    </div>
</div>
@stop


