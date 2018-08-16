@extends('layouts.base')
@section('breadcrumb')
    <li class=""><a href="{{ route('cash.registers.edit', $register)}}">regresar a caja</a></li>
@stop
@section('content')
<div class="row hidden-print">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
        <div class="smallstat">
            <i class="fa fa-inbox info text-muted hidden-xs"></i>
            <span class="value text-success">Q. {{ $register->sales->sum('total') + $register->payments->sum('amount') }}</span>
            <a href="{{ route('cash.registers.edit', $register)}}" class="title">Caja</a>
        </div><!--/.smallstat-->
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="smallstat">
            <span class="value text-muted">Q. {{ $register->payments->sum('amount') }}</span>
            <span class="title">Pagos a creditos</span>
        </div><!--/.smallstat-->
    </div><!--/.col-->
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Pagos a Creditos</strong>
                <small>Listado</small>
            </div>
            <div class="panel-body">
                <div class="table-resposive">
                    <table class="table col-sm-12">
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>baucher</th>
                            <th>Pago</th>
                            <th>Crédito</th>
                            <th>Vendedor</th>
                            <td class="hidden-print"></td>
                        </tr>
                        @foreach ($register->payments as $payment)
                        <tr>
                            <td>{{ $payment->order->created_at->format('d-m-Y') }}</td>
                            <td>{{ $payment->order->people->name }}</td>
                            <td>{{ $payment->baucher}}</td>
                            <td>Q. {{ $payment->amount }}</td>
                            <td>{{ $payment->order->total }}</td>
                            <td>{{ $payment->order->user->name }}</td>

                            <td class="hidden-print"><a href="{{ $payment->order->urlBill }}" class="btn btn-info "> <i class="fa fa-eye-o"></i>  Ver Factura</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
