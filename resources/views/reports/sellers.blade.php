@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Existencias</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-cubes"></i>
                <strong>Top vendedores</strong>
                <small>Listado</small>
            </div>
            <div class="panel-body">
                <div class="row">
                    @include('reports.partials.search_sellers')
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Vendedor</th>
                                    <th>Ventas</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sellers as $seller)
                                    <tr>
                                        <td>{{ $seller->name }}</td>
                                        <td>{{ $seller->sales }}</td>
                                        <td>Q. {{ $seller->totals }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
            {{ $sellers->links() }}
            </div>
        </div>
    </div>
</div>
@stop


