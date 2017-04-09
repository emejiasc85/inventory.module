@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Ordenes</a></li>
	 <li class="breadcrumb-item"><a href="{{ $order->url }}">Orden #{{ $order->id }}</a></li>
	 <li class="breadcrumb-item active">Agregar Producto</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-list-ol"></i>
                    <strong>Orden</strong>
                    <small>Agregar Producto</small>
                </div>
                <div class="panel-body">

                 @include('orders.details.partials.search')
                 <br>
                 @include('orders.details.partials.table')
                </div>
            </div>
        </div>
	</div>
@stop
@section('modals')
     @include('orders.details.partials.add_product')
@stop
@section('scripts')
  <script>
    //on click show modal with hidden form to update status
    $('.add-product').click( function (e) {
      e.preventDefault();
      var link    = $(this)
      var value   = link.data('id');
      var name    = link.data('name');
      var input_value = $('#value_id');
      var ProductName = $('#ProductName');
      input_value.val(value);
      ProductName.text(name);
      $('#addProduct').modal('toggle');
    });
  </script>
@stop


