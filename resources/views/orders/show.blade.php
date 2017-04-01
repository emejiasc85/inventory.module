@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Ordenes</a></li>
	 <li class="breadcrumb-item active">Orden #{{ $order->id }}</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-4">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-list-ol"></i>
                    <strong>Orden</strong>
                    <i class="badge">{{ $order->id }}</i>
                    <span {!! Html::classes(['pull-right label', 'label-info' => $order->status == 'Creado', 'label-primary' => $order->status == 'Solicitado', 'label-warning' => $order->status == 'Confirmado', 'label-success' => $order->status == 'Entregado', 'label-default' => $order->status == 'Cancelado']) !!}>{{ $order->status }}
                    </span>
                </div>
				<div class="panel-body">
                    <table class="table">
                        <tr>
                            <th class="text-right">Tipo:</th>
                            <td>{{ $order->type->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Prioridad:</th>
                            <td>
                                <span {!! Html::classes(['label', 'label-danger' => $order->priority == 'Alta', 'label-warning' => $order->priority == 'Media', 'label-success' => $order->priority == 'Baja']) !!}>{{ $order->priority }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Proveedor:</th>
                            <td>{{ $order->provider->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Fec. Creación:</th>
                            <td>{{ $order->created_at->format('d-m-y') }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Costo:</th>
                            <td>{{ $order->total }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Fec. de ingreso:</th>
                            <td>
                                @if ($order->delivery)
                                    {{ $order->delivery->format('d-m-y') }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-body">
                   <table class="table table-striped">
                    <thead>
                    <tr>
                         <th>Producto</th>
                         <th>Cant</th>
                         <th>P/U</th>
                         <th>Total</th>
                         <th>Fec. Vencimiento</th>
                         <th colspan="2"><a href="{{ route('orders.details.create', $order) }}" class="btn btn-primary"><i class="fa fa-plus"></i></a></th>
                     </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->details as $detail)
                             <tr>
                                 <td>{{ $detail->product->name}}</td>
                                 <td>{{ $detail->lot}}</td>
                                 <td>{{ $detail->cost}}</td>
                                 <td>{{ $detail->total}}</td>
                                 <td>{{ $detail->due_date}}</td>
                                 <td><a href="" class="btn btn-success"><i class="fa fa-pencil"></i></a></td>
                                 <td><a href="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></a></td>
                             </tr>
                         @endforeach
                    </tbody>
                 </table>
                </div>
            </div>

        </div>
	</div>
@stop


