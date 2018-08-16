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
        <a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 1])}}">
        <div class="smallstat">
            <i class="fa fa-money success text-muted hidden-xs"></i>
            <span class="value text-muted">Q. {{ $register->sales->where('payment_method_id', 1)->sum('total') }}</span>
            <span class="title">Efectivo</span>
        </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 2])}}">
        <div class="smallstat">
            <i class="fa fa-credit-card info text-muted hidden-xs"></i>
            <span class="value text-muted">Q. {{ $register->sales->where('payment_method_id', 2)->sum('total') }}</span>
            <span class="title">Tarjeta</span>
        </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 3])}}">
        <div class="smallstat">
            <i class="fa fa-bank info text-muted hidden-xs"></i>
            <span class="value text-muted">Q. {{ $register->sales->where('payment_method_id', 3)->sum('total') }}</span>
            <span class="title">Cheques</span>
        </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 4])}}">
        <div class="smallstat">
            <i class="fa fa-inbox warning text-muted hidden-xs"></i>
            <span class="value text-muted">Q. {{ $register->sales->where('payment_method_id', 4)->sum('total') }}</span>
            <span class="title">Creditos</span>
        </div><!--/.smallstat-->
        </a>
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
                            <th>Metódo</th>
                            <th>Doc</th>
                            <th>Estado</th>
                            <td class="hidden-print"></td>
                        </tr>
                        @php
                            $sales = $register->sales;
                            if(request()->has('payment_method_id')){
                                $sales = $register->sales->where('payment_method_id', request()->payment_method_id);
                            }
                        @endphp

                        @foreach ($sales as $bill)
                        <tr>
                            <td>{{ $bill->created_at->format('d-m-Y') }}</td>
                            <td>{{ $bill->people->name }}</td>
                            <td>{{ $bill->details->sum('lot') }}</td>
                            <td>Q. {{ $bill->total }}</td>
                            <td>{{ $bill->user->name }}</td>
                            <td>{{ $bill->payment_method->name }}</td>
                            <td>{{ $bill->voucher }}</td>

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
