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
            <span class="value text-muted">Q. {{ $register->sales->sum('total') }}</span>
            <span class="title">Ventas</span>
        </div><!--/.smallstat-->
    </div><!--/.col-->
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Ventas</strong>
                <small>Listado</small>
            </div>
            <div class="panel-body">
                <div class="table-resposive">
                    <table class="table col-sm-12">
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th>Vendedor</th>
                            <th>Crédito</th>
                            <th>Estado</th>
                            <td class="hidden-print"></td>
                        </tr>
                        @foreach ($register->sales as $bill)
                        <tr>
                            <td>{{ $bill->created_at->format('d-m-Y') }}</td>
                            <td>{{ $bill->people->name }}</td>
                            <td>{{ $bill->details->sum('lot') }}</td>
                            <td>Q. {{ $bill->total }}</td>
                            <td>{{ $bill->user->name }}</td>
                            <td>
                                @if ($bill->credit)
                                    <span class="fa fa-check text-success"></span>
                                @endif
                            </td>
                            <td>
                                @if ($bill->status == 'Ingresado')
                                    <span class="label label-success">Facturado</span>
                                @elseif($bill->status == 'Creado')
                                    <span class="label label-warning">No Facturado</span>
                                @endif
                            </td>
                            <td class="hidden-print"><a href="{{ $bill->urlBill }}" class="btn btn-info "> <i class="fa fa-eye-o"></i>  Ver Detalle</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
