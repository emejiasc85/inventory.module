@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Pedidos</a></li>
	 <li class="breadcrumb-item active">Pedido #{{ $order->id }}</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-3">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <strong>Pedido</strong>
                    <i class="badge pull-right">{{ $order->id }}</i>
                </div>
				<div class="panel-body">
                    <table class="table">
                        <tr>
                            <th class="text-left">Prioridad:</th>
                            <td class="text-right">
                                <span {!! Html::classes(['label', 'label-danger' => $order->priority == 'Alta', 'label-warning' => $order->priority == 'Media', 'label-success' => $order->priority == 'Baja']) !!}>{{ $order->priority }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left">Proveedor:</th>
                            <td class="text-right">{{ $order->provider->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-left">Creado: </th>
                            <td class="text-right">{{ $order->created_at->format('d-m-y') }}</td>
                        </tr>
                        <tr>
                            <th class="text-left">Ingresó: </th>
                            <td class="text-right">
                                @if ($order->status == 'Ingresado')
                                    {{ $order->updated_at->format('d-m-y') }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>
                    @if ($order->status == 'Cancelado')
                    <h2 class="text-muted">Pedido Cancelada</h2>
                    @elseif($order->status == 'Ingresado')
                    <a href="" class="btn btn-default btn-block">Revertir</a>
                    @else
                        @if ($order->details->count()>0)
                        <a href="#" id="OrderStatus" data-status="{{ $order->status }}" {!! Html::classes([
                            'btn btn-block',
                            'btn-primary' => $order->status == 'Creado',
                            'btn-success' => $order->status == 'Solicitado',
                        ]) !!}>
                            @if ($order->status == 'Creado')
                                Solicitar Pedido
                            @elseif ($order->status == 'Solicitado')
                                Ingresar Pedido
                            @endif
                        </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9">
            <div class="panel panel-default" style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <span {!! Html::classes(['pull-right label', 'label-info' => $order->status == 'Creado', 'label-primary' => $order->status == 'Solicitado', 'label-success' => $order->status == 'Ingresado', 'label-default' => $order->status == 'Cancelado']) !!}>{{ $order->status }}
                    </span>
                </div>
                <div class="panel-body">
                    {!! Form::open([ 'route' => ['orders.details.update', $order], 'method' => 'PUT']) !!}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                 <th>
                                    @if ($order->status == 'Creado' || $order->status == 'Solicitado')
                                        <a href="{{ route('orders.details.create', $order) }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
                                    @endif
                                 </th>
                                 <th>Producto</th>
                                 <th>Cant</th>
                                 <th>Precio Compra</th>
                                 <th>Precio Venta</th>
                                 <th>Vencimiento</th>
                                 <th class="text-right">Costo Total</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->details as $detail)
                            <tr>
                                {!! Field::hidden('id[]', $detail->id)  !!}
                                <td>
                                    @if ($order->status == 'Creado' || $order->status == 'Solicitado')
                                    <a href="#" data-id="{{ $detail->id }}"  data-name="{{ $detail->product->name }}" class="btn btn-danger btn-xs OrderDetailDelete"><i class="fa fa-minus-circle"></i></a>
                                    @endif
                                </td>
                                <td>{{ $detail->product->name}}</td>
                                 @if ($order->status == 'Ingresado' || $order->status == 'Cancelado')
                                    <td>{{ $detail->lot }}</td>
                                    <td>Q. {{ $detail->purchase_price }}</td>
                                    <td>Q. {{ $detail->sale_price }}</td>
                                    <td>{{ $detail->due_date }}</td>
                                    <td class="text-right">Q. {{ $detail->total_purchase}}</td>
                                @else
                                    <td class="col-xs-1"><input type="text" name="lot[]" class="form-control input-sm" value="{{ $detail->lot }} "></td>
                                    <td class="col-xs-1"><input type="text" name="purchase_price[]" class="form-control input-sm" value="{{ $detail->purchase_price }}"></td>
                                    <td class="col-xs-1"><input type="text" name="sale_price[]" class="form-control input-sm" value="{{ $detail->sale_price }}"></td>
                                    <td class="col-xs-1"><input type="date" name="due_date[]" class="form-control input-sm" value="{{ $detail->due_date }}"></td>
                                    <td class="text-right"><strong>Q. {{ $detail->total_purchase }}</strong></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                 </table>
                 <div class="row">
                     <div class="col-lg-4 col-lg-offset-8 col-sm-5 col-sm-offset-4 recap">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left"><strong>Costo Total</strong></td>
                                    <td class="right"><strong>Q. {{ $order->total }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        @if ($order->status == 'Creado' || $order->status == 'Solicitado')
                            @if ($order->details->count()>0)
                                <button type="submit" class="btn btn-default btn-block"><i class="fa fa-save"></i> Guardar</button>
                            @endif
                        @endif
                    </div>

                 </div>
                {!! Form::close() !!}
                </div>
            </div>

        </div>
	</div>
@stop
@section('modals')
    @include('orders.details.partials.modal-destroy')
    @include('orders.partials.changeStatus')
@stop
@section('scripts')
    <script>
        $('.OrderDetailDelete').click( function (e) {
            e.preventDefault();
            var link    = $(this)
            var value   = link.data('id');
            var name   = link.data('name');
            var input_value = $('#value_id');
            var ProductName = $('#ProductName');
            input_value.val(value);
            ProductName.text(name);
            $('#confirmDelete').modal('toggle');
        });


        $('#OrderStatus').click(function (e) {
            e.preventDefault();
            var link    = $(this)
            var status   = link.data('status');
            var input_value = $('#value_status');
            if(status == 'Creado'){
                input_value.val('Solicitado');
            }
            else if(status=='Solicitado'){
                input_value.val('Ingresado');
            }
            $('#changeStatus').modal('toggle');
        });
    </script>

@stop


