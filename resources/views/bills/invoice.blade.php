@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('bills.index') }}">Caja</a></li>
<li class="breadcrumb-item"><a href="">Factura</a></li>
@stop

@section('content')
@include('partials.errors')
<div class="row header">
    @if ($order->status != 'Ingresado')
        <div class="col-sm-7">
            @include('bills.partials.details')
        </div>
    @endif
    @if($order->payments->where('payment_method_id', 6)->count() > 0 || $order->credit)
    <div class="col-sm-7">
        <div class="panel panel-default ">
            <div class="panel-body">
            <div class="panel-heading">
                Pagos
                <a href="#" id="add_payment" class="btn btn-sm btn-primary pull-right"><span class="fa fa-plus"></span> Agregar</a>
            </div>
            <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <td style="width:40px"></td>
                    <td>Fecha</td>
                    <td>Doc.</td>
                    <td class="text-right">Monto</td>
                </tr>
                @foreach($order->payments->whereIn('payment_method_id', [6,7]) as $payment)
                <tr>
                    <td>
                        @if (auth()->user()->isAdmin())
                            <a href=""  data-id="{{$payment->id}}" class="btn btn-sm btn-link destroy_payment"><i class="fa fa-trash text-danger"></i></a>
                        @endif
                    </td>
                    <td>{{ $payment->created_at->format('d-m-Y')}}</td>
                    <td>{{ $payment->baucher}}</td>
                    <td class="text-right">{{ number_format($payment->amount,2)}}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Total Pagos</strong></td>
                    <th class="text-right">{{ number_format($order->payments->whereIn('payment_method_id', [6,7])->sum('amount'),2)}}</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td ><strong>Total Factura</strong></td>
                    <th class="text-right">{{ number_format($order->payments->where('payment_method_id', 4)->sum('amount'),2)}}</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td ><strong>Resta</strong></td>
                    <th class="text-right">{{ number_format($order->payments->where('payment_method_id', 4)->sum('amount') - $order->payments->whereIn('payment_method_id', [6,7])->sum('amount'),2)}}</th>
                </tr>
            </table>
            </div>
            </div>
        </div>
    </div>
    @endif
    <div {!! Html::classes(['col-sm-5', 'col-sm-offset-3' => $order->status == 'Ingresado && !$order->credit' ]) !!}>
        @include('bills.partials.head')
    </div><!--/col-->
</div><!--/row-->

@stop
@section('modals')
@include('bills.partials.modal_confirm_bill')
@include('bills.partials.modal_add_payment')
@include('bills.partials.modal_destroy_payment')
@include('bills.partials.modal_detail_destroy')
@include('bills.partials.modal_bill_destroy')
@include('bills.partials.add_product')
@include('bills.partials.modal_revert')

@stop
@section('scripts')
<script>
$(document).ready(function() {
   $("#barcode").focus();
});

{{--
@if ($order->status == 'Ingresado' && !$order->credit)
    $(document).ready(function() {
        window.print()
    });
@endif
--}}
//on click show modal with hidden form to update status
$('.add-product').click( function (e) {
    e.preventDefault();
    var link              = $(this)
    var value             = link.data('id');
    var name              = link.data('name');
    var price             = link.data('price');
    var offer_price       = link.data('offer');
    var input_value       = $('#product_id');
    var input_price       = $('#sale_price');
    var input_offer_price = $('#offer_price');
    var ProductName       = $('#addProductName');
    input_value.val(value);
    input_price.val(price);
    input_offer_price.val(offer_price);
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

$('.destroy_payment').click( function (e) {
    e.preventDefault();
    var link        = $(this)
    var value       = link.data('id');
    var input_value = $('#payment');
    input_value.val(value);
    $('#destroyPayment').modal('toggle');
});



$('#DestroyBill').click( function (e) {
    e.preventDefault();
    var link        = $(this)
    $('#confirmDeleteBill').modal('toggle');
});

$('#RevertBill').click( function (e) {
    e.preventDefault();
    var link        = $(this)
    $('#ConfirmRevertBill').modal('toggle');
});

$('#Bill').click( function (e) {
    e.preventDefault();
    $('#ConfirmBill').modal('toggle');
});
$('#add_payment').click( function (e) {
    e.preventDefault();
    $('#addPayment').modal('toggle');
});

$('.showVoucher').click( function (e){
    //e.preventDefault();
    $('#collapseVoucher').collapse('show')
});

$('.hideVoucher').click( function (e){
    //e.preventDefault();
    $('#collapseVoucher').collapse('hide')
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
