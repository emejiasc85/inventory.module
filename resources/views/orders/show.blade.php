@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Ordenes</a></li>
	 <li class="breadcrumb-item active">Orden #{{ $order->id }}</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-3">
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
                    @if ($order->status == 'Cancelado')
                    <h2 class="text-muted">Orden Cancelada</h2>
                    @else
                        <a href="#" id="OrderStatus" data-status="{{ $order->status }}" {!! Html::classes([
                            'btn btn-block',
                            'btn-primary' => $order->status == 'Creado',
                            'label-warning' => $order->status == 'Solicitado',
                            'label-success' => $order->status == 'Confirmado',
                        ]) !!}>
                            @if ($order->status == 'Creado')
                                Solicitar
                            @elseif ($order->status == 'Solicitado')
                                Confirmar
                            @elseif ($order->status == 'Confirmado')
                                Ingresar
                            @endif
                            <i class="fa fa-angle-double-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9">
            <div class="panel panel-default" style="border-top: 2px solid #20a8d8">
                <div class="panel-body">
                   <table class="table table-striped">
                    <thead>
                    <tr>
                         <th>Producto</th>
                         <th>Cant</th>
                         <th>C/U</th>
                         <th>Fec. Vencimiento</th>
                         <th>Total</th>
                         <th colspan="2"><a href="{{ route('orders.details.create', $order) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Producto</a></th>
                     </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->details as $detail)
                            <tr>
                                <td>{{ $detail->product->name}}</td>
                                {!! Form::open([$detail, 'route' => ['orders.details.update', $detail], 'method' => 'PUT']) !!}
                                <td class="col-xs-1"><input type="text" name="lot" class="form-control" value="{{ $detail->lot }}"></td>
                                <td class="col-xs-1"><input type="text" name="cost" class="form-control" value="{{ $detail->cost }}"></td>
                                <td class="col-xs-1"><input type="date" name="due_date" class="form-control" value="{{ $detail->due_date }}"></td>
                                <td>Q. {{ $detail->total}}</td>
                                <td><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Editar</button></td>
                                {!! Form::close() !!}
                                <td><a href="#" data-id="{{ $detail->id }}"  data-name="{{ $detail->product->name }}" class="btn btn-danger OrderDetailDelete"><i class="fa fa-minus-circle"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
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
                input_value.val('Confirmado');
            }
            else if(status=='Confirmado'){
                input_value.val('Entregado');
            }

            $('#changeStatus').modal('toggle');
        });
    </script>

@stop


