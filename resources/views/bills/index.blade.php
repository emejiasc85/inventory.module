@extends('layouts.base')
@section('breadcrumb')
    <li class="breadcrumb-item">Ventas</li>
@stop
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-xxs-12">
        <a  href="{{ route('bills.create') }}">
            <div class="smallstat">
                <i class="fa fa-shopping-cart primary"></i>
                <span class="value text-primary">Facturar</span>
            </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->

    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="smallstat">
            <span class="value text-muted">Q. {{ $register->sales->sum('total') }}</span>
            <span class="title">Ventas</span>
        </div><!--/.smallstat-->
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="smallstat">
            <span class="value text-muted">Q. {{ $register->payments->whereIn('payment_method_id', [6,7])->sum('amount') }}</span>
            <span class="title">Abono a credito</span>
        </div><!--/.smallstat-->
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="smallstat">
            <span class="value text-muted">Q. {{ $register->payments->where('payment_method_id', 4)->sum('amount') }}</span>
            <span class="title">Creditos</span>
        </div><!--/.smallstat-->
    </div><!--/.col-->
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
        <div class="smallstat">
            <i class="fa fa-inbox info text-muted hidden-xs"></i>
            <span class="value text-success">Q. {{ $register->sales->sum('total') + $register->payments->where('payment_method_id', 6)->sum('amount') }}</span>
            <a href="{{ route('cash.registers.resume', $register)}}" class="title">Caja</a>
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
                @include('bills.partials.search_sales')
                <div class="table-resposive">
                    <table class="table col-sm-12">
                        <tr>
                            <th>Referencia</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th>Vendedor</th>
                            <th>Metódo</th>
                            <th>Estado</th>
                            <td></td>
                        </tr>
                        @foreach ($bills as $bill)
                        <tr>
                            <td>{{ $bill->id }}</td>
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
                                @if ($bill->payments->whereIn('payment_method_id', [6,7])->count() > 0)
                                    <span class="label label-success">Abonos</span>

                                @endif
                            </td>
                            <td>
                                @if ($bill->status == 'Ingresado')
                                    <span class="label label-success">Facturado</span>
                                @elseif($bill->status == 'Creado')
                                    <span class="label label-default">No Facturado</span>
                                @endif
                            </td>
                            <td><a href="{{ $bill->urlBill }}" class="btn btn-link "> <i class="fa fa-eye text-info"></i> Detalle</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                {{ $bills->links() }}
            </div>
        </div>
    </div>
</div>

@stop
