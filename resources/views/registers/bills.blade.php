@extends('layouts.base')
@section('breadcrumb')
    <li class=""><a href="{{ route('cash.registers.resume', $register)}}">regresar a caja</a></li>
@stop
@section('content')
<div class="row hidden-print">
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <div class="smallstat">
            <i class="fa fa-inbox info text-muted hidden-xs"></i>
            <span class="value">Q. {{ number_format($register->payments->whereIn('payment_method_id', [1,2,3,6])->sum('amount'),2) }}</span>
            <a href="{{ route('cash.registers.resume', $register)}}" class="title">Caja</a>
        </div><!--/.smallstat-->
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 1])}}">
        <div class="smallstat">
            <span class="value text-muted">Q. {{ number_format($register->payments->whereIn('payment_method_id', [1])->sum('amount'),2) }}</span>
            <span class="title">Efectivo</span>
        </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 2])}}">
        <div class="smallstat">
            <span class="value text-muted">Q. {{ number_format($register->payments->whereIn('payment_method_id', [2])->sum('amount'),2) }}</span>
            <span class="title">Tarjeta</span>
        </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 3])}}">
        <div class="smallstat">
            <span class="value text-muted">Q. {{ number_format($register->payments->whereIn('payment_method_id', [3])->sum('amount'),2) }}</span>
            <span class="title">Cheques</span>
        </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 4])}}">
        <div class="smallstat">
            <span class="value text-muted">Q. {{ number_format($register->payments->whereIn('payment_method_id', [4])->sum('amount'),2) }}</span>
            <span class="title">Creditos</span>
        </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 4])}}">
        <div class="smallstat">

            <span class="value text-muted">Q. {{ number_format($register->payments->whereIn('payment_method_id', [6])->sum('amount'),2) }}</span>
            <span class="title">Abonos </span>
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
                            <th>Estado</th>
                            <td class="hidden-print"></td>
                        </tr>


                        @foreach ($sales as $bill)
                        <tr>
                            <td>{{ $bill->created_at->format('d-m-Y') }}</td>
                            <td>{{ $bill->people->name }}</td>
                            <td>{{ $bill->details->sum('lot') }}</td>
                            <td>Q. {{ $bill->total }}</td>
                            <td>{{ $bill->user->name }}</td>
                            <td>
                                    @if ($bill->payments->count() > 0)
                                    @foreach ($bill->payments->whereIn('payment_method_id', [1,2,3,4,5]) as $payment)
                                            @if ($payment->payment_method_id == 1)
                                                <span class="label label-success">{{ $payment->payment_method->name}}</span>
                                            @endif
                                            @if ($payment->payment_method_id == 2)
                                                <span class="label label-primary">{{ $payment->payment_method->name}}</span>
                                            @endif
                                            @if ($payment->payment_method_id == 3)
                                                <span class="label label-info">{{ $payment->payment_method->name}}</span>
                                            @endif
                                            @if ($payment->payment_method_id == 4)
                                                <span class="label label-danger">{{ $payment->payment_method->name}}</span>
                                            @endif
                                            @if ($payment->payment_method_id == 5)
                                                <span class="label label-default">{{ $payment->payment_method->name}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if ($bill->payments->where('payment_method_id', 6)->count() > 0)
                                        <span class="label label-success">Abonos</span>
                                    @endif
                            </td>
                            <td>
                                @if ($bill->status == 'Ingresado')
                                    <span class="label label-success">Facturado</span>
                                @elseif($bill->status == 'Creado')
                                    <span class="label label-warning">No Facturado</span>
                                @endif
                            </td>
                            <td class="hidden-print"><a href="{{ $bill->urlBill }}" class="btn btn-link btn-sm"> <i class="fa fa-eye text-info"></i> Detalle</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
