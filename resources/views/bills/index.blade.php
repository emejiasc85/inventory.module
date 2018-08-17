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
            <span class="value text-muted">Q. {{ $register->payments->sum('amount') }}</span>
            <span class="title">Abono a credito</span>
        </div><!--/.smallstat-->
    </div><!--/.col-->
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="smallstat">
            <span class="value text-muted">Q. {{ $register->credits->sum('total') }}</span>
            <span class="title">Creditos</span>
        </div><!--/.smallstat-->
    </div><!--/.col-->
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
        <div class="smallstat">
            <i class="fa fa-inbox info text-muted hidden-xs"></i>
            <span class="value text-success">Q. {{ $register->sales->sum('total') + $register->payments->sum('amount') }}</span>
            <a href="{{ route('cash.registers.edit', $register)}}" class="title">Caja</a>
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
                            <th>Doc.</th>
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
                            <td>{{ $bill->payment_method ? $bill->payment_method->name: '' }}</td>
                            <td>{{ $bill->voucher}}</td>
                            <td>
                                @if ($bill->status == 'Ingresado')
                                    <span class="label label-success">Facturado</span>
                                @elseif($bill->status == 'Creado')
                                    <span class="label label-warning">No Facturado</span>
                                @endif
                            </td>
                            <td><a href="{{ $bill->urlBill }}" class="btn btn-info "> <i class="fa fa-eye-o"></i>  Ver Detalle</a></td>
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
