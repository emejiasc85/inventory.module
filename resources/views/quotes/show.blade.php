@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('quotes.index') }}">Cotizaciones</a></li>
<li class="breadcrumb-item">Cotización #{{ $order->quotation->id }}</li>
@stop

@section('content')
@include('partials.errors')
<div class="row header">
    @if ($order->status != 'Ingresado')
        <div class="col-sm-7">
            @include('quotes.partials.details')
        </div>
    @endif
    <div {!! Html::classes(['col-sm-5', 'col-sm-offset-3' => $order->status == 'Ingresado' ]) !!}>
        @include('quotes.partials.head')
    </div><!--/col-->
</div><!--/row-->

@stop
@section('modals')
    @include('quotes.partials.modal_confirm')
    @include('quotes.partials.modal_revert')
    @include('quotes.partials.modal_detail_destroy')
    @include('quotes.partials.modal_quotation_destroy')
    @include('quotes.partials.add_product')
@stop
@section('scripts')
<script>

@if ($order->status == 'Ingresado')
    $(document).ready(function() {
        window.print()
    });
@endif
//on click show modal with hidden form to update status
$('.add-product').click( function (e) {
    e.preventDefault();
    var link        = $(this)
    var value       = link.data('id');
    var name        = link.data('name');
    var price       = link.data('price');
    var input_value = $('#product_id');
    var input_price = $('#sale_price');
    var ProductName = $('#addProductName');
    input_value.val(value);
    input_price.val(price);
    ProductName.html(name);

    $('#addProduct').modal('toggle');
});

$('#AddProductButton').on('click', function (e) {
    e.preventDefault();
    if($('#lot').val() === ''){
        alert('Debe llenar el campo cantidad');
    }
    else{
        $(this).attr('disabled', 'disabled');
        $(this).text('Espere...')
        $('#AddProductForm').submit();
    }
});

$('.OrderDetailDelete').click( function (e) {
    e.preventDefault();
    var link        = $(this)
    var value       = link.data('id');
    var name        = link.data('name');
    var input_value = $('#value_id');
    var ProductName = $('#ProductName');
    input_value.val(value);
    ProductName.text(name);
    $('#confirmDelete').modal('toggle');
});

$('#DestroyOrder').click( function (e) {
    e.preventDefault();
    var link        = $(this)
    $('#confirmDeleteBill').modal('toggle');
});

$('#RevertOrder').click( function (e) {
    e.preventDefault();
    var link        = $(this)
    $('#ConfirmRevertOrder').modal('toggle');
});

$('#Order').click( function (e) {
    e.preventDefault();
    $('#ConfirmBill').modal('toggle');
});

$('#OrderStatus').click(function (e) {
    e.preventDefault();
    var link        = $(this)
    var status      = link.data('status');
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


