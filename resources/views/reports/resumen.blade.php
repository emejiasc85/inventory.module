@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Resumen</li>
<li class="breadcrumb-item">Movimientos</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-cubes"></i>
                <strong>Movimientos</strong>
                <small>Listado</small>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Orden</th>
                                    <th>Fecha</th>
                                    <th>Cliente/Proveedor</th>
                                    <th>Tipo</th>
                                    <th>Haber</th>
                                    <th>Debe</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->people->name }}</td>
                                        <td>{{ $order->type->name }}</td>
                                        @if ($order->type->id == 1)
                                            <td></td>
                                            <td>Q. {{ round($order->total, 2) }}</td>
                                        @elseif($order->type->id == 2)
                                            <td>Q. {{ round($order->total, 2) }}</td>
                                            <td></td>
                                        @endif
                                        <td>{{ $order->user->name }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
            {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@stop


