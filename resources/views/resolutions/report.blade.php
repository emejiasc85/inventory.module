@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('resolutions.index')}}">Resoluciones</a></li>
<li class="breadcrumb-item">Resolucion</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Resolucion</strong>
                <small>Reporte</small>
            </div>
            <div class="panel-body">
                <div class="table-resposive">
                    <table class="table col-sm-12">
                        <tr>
                            <th>Factura</th>
                            <th>Cantidad</th>
                            <th>Estado</th>

                        </tr>
                        @foreach ($resolution->bills as $bill)
                        <tr>
                            <td>{{ $bill->bill }}</td>
                            <td>
                                @if ($bill->order)
                                    {{ $bill->order->total }}
                                @endif
                            </td>
                            <td>
                                @if ($bill->status)
                                    <span class="label label-default">Activa</span>
                                @endif
                                @if (!$bill->status)
                                    <span class="label label-danger">Anulada</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@stop
