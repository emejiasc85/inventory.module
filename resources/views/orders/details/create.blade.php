@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Pedidos</a></li>
<li class="breadcrumb-item"><a href="{{ $order->url }}">Pedido #{{ $order->id }}</a></li>
<li class="breadcrumb-item active">Agregar Producto</li>
@stop

@section('content')
@include('partials.errors')
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
            <div class="panel-heading">
                <i class="fa fa-list-ol"></i>
                <strong>Pedido #{{ $order->id }}</strong>
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

    $('#AddProductButton').on('click', function (e) {
        e.preventDefault();
        $(this).attr('disabled', 'disabled');
        $(this).text('Espere...')
        $('#AddProductForm').submit();
    })
</script>
@stop


