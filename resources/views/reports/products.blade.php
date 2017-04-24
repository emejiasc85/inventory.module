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
                <strong>Top Productos</strong>
                <small>Listado</small>
            </div>
            <div class="panel-body">
                <div class="row">
                    @include('reports.partials.search_products')
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><a href="{{ $product->url}}">{{ $product->name }}</a></td>
                                        <td>{{ $product->cant }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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


