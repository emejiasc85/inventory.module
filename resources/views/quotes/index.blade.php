@extends('layouts.base')
@section('breadcrumb')
    <li class="breadcrumb-item">Cotizaciones</li>
@stop
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Cotizaciones</strong>
                <small>Listado</small>
                <a href="{{ route('quotes.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Agregar Cotización</a>
            </div>
            <div class="panel-body">
                @include('bills.partials.search_sales')
                <div class="table-resposive">
                    <table class="table col-sm-12">
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th>Vendedor</th>
                            <th>Estado</th>
                            <td></td>
                        </tr>
                        @foreach ($quotes as $quotation)
                        <tr>
                            <td>{{ $quotation->created_at->format('d-m-Y') }}</td>
                            <td>{{ $quotation->people->name }}</td>
                            <td>{{ $quotation->details->sum('lot') }}</td>
                            <td>Q. {{ $quotation->total }}</td>
                            <td>{{ $quotation->user->name }}</td>
                            <td>
                                <span {!! Html::classes([
                                    'label', 'label-info' => $quotation->status == 'Creado',
                                    'label-primary' => $quotation->status == 'Solicitado',
                                    'label-success' => $quotation->status == 'Ingresado',
                                    'label-default' => $quotation->status == 'Cancelado'
                                    ]) !!}>{{ $quotation->status }}</span>
                            </td>
                            <td><a href="{{ $quotation->urlQuotation }}" class="btn btn-info "> <i class="fa fa-eye-o"></i>  Ver Detalle</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                {{ $quotes->links() }}
            </div>
        </div>
    </div>
</div>

@stop



