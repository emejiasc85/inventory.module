@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Reporte</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-left">
                    <i class="fa fa-cubes"></i>
                    <strong>Top Productos por fechas</strong>
                    <small>Listado</small>
                </div>
                <div class="pull-right">
                    <a href="{{ route('reports.products', Request::all() ) }}" class="btn btn-default">Agrupar por producto</a>
                    <a href="{{ route('reports.products.group.byDate.download', Request::all()) }}" class="btn btn-default"><i class="fa fa-download"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    @include('reports.partials.search_products')
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            @include('reports.partials.table_by_date')
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
            {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@stop


