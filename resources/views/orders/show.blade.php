@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Pedidos</a></li>
	 <li class="breadcrumb-item active">Pedido #{{ $order->id }}</li>
@stop

@section('content')
	<div class="row">
        @include('partials.errors')
		<div class="col-xs-12 col-sm-3">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    @if ($order->status == 'Creado' || $order->status == 'Solicitado')
                        <a href="{{ $order->editUrl }}" class="btn btn-success btn-sm"> <i class="fa fa-pencil"></i></a>
                    @endif
                    <strong>Pedido</strong>
                    <i class="badge pull-right">{{ $order->id }}</i>
                </div>
				<div class="panel-body">
                @include('orders.partials.head')
                    @if ($order->status == 'Ingresado' && !auth()->user()->isAdmin())
                    <h2 class="text-muted">Pedido Ingresado</h2>
                    @else
                        @if ($order->details->count()>0)
                        <a href="#" id="OrderStatus" data-status="{{ $order->status }}" {!! Html::classes([
                            'btn btn-block',
                            'btn-primary' => $order->status == 'Creado',
                            'btn-success' => $order->status == 'Solicitado',
                            'btn-default' => $order->status == 'Ingresado',
                        ]) !!}>
                            @if ($order->status == 'Creado')
                                Solicitar Pedido
                            @elseif ($order->status == 'Solicitado')
                                Ingresar Pedido
                            @elseif ($order->status == 'Ingresado')
                                Revertir Pedido
                            @endif
                        </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9">
            @include('orders.partials.details')
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
            else if(status=='Ingresado'){
                input_value.val('Revertir');
            }
            $('#changeStatus').modal('toggle');
        });
    </script>

@stop
