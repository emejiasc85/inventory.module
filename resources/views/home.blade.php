@extends('layouts.base')

@section('content')
<style>
.smallstat:hover {
-webkit-box-shadow: 17px 21px 58px -13px rgba(0,0,0,0.75);
-moz-box-shadow: 17px 21px 58px -13px rgba(0,0,0,0.75);
box-shadow: 17px 21px 58px -13px rgba(0,0,0,0.75);
}
</style>
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="/sales/invoice">
            <div class="smallstat">
                <i class="fa fa-shopping-cart primary"></i>
                <span class="value text-primary">Facturar</span>
            </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{ route('bills.index') }}">
            <div class="smallstat">
                <i class="fa fa-inbox info"></i>
                <span class="value text-info">Caja</span>
            </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->

    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{  route('products.index') }}">
            <div class="smallstat">
                <i class="fa fa-barcode warning" style="background-color:#487eb0"></i>
                <span class="value" style="color: #487eb0">Productos</span>
            </div><!--/.smallstat-->
        </a>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{ route('stocks.index') }}">
            <div class="smallstat">
                <i class="fa fa-cubes info" style="background-color: #3498db"></i>
                <span class="value text-info" style="color: #3498db">Existencias</span>
            </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->



    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{ route('quotes.create') }}">
            <div class="smallstat">
                <i class="fa fa-calendar primary" style="background-color: #778899"></i>
                <span class="value" style="color: #778899">Cotizar</span>
            </div><!--/.smallstat-->
        </a>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
            <a  href="{{ route('cash.registers.index') }}">
                <div class="smallstat">
                    <i class="fa fa-bar-chart-o success" style="background-color:#7f8c8d"></i>
                    <span class="value text-success" style="color:#7f8c8d">Ventas</span>
                </div><!--/.smallstat-->
            </a>
        </div><!--/.col-->








    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{ route('people.index') }}">
            <div class="smallstat">
                <i class="fa fa-users primary" style="background-color: #778899"></i>
                <span class="value" style="color: #778899">Personas</span>
            </div><!--/.smallstat-->
        </a>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{ route('orders.index') }}">
            <div class="smallstat">
                <i class="fa fa-truck " style="background-color: #95a5a6"></i>
                <span class="value" style="color: #95a5a6">Pedidos</span>
            </div><!--/.smallstat-->
        </a>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="/gift-cards">
            <div class="smallstat" >
                <i class="fa fa-gift " style="background-color: #badc58"></i>
                <span class="value " style="color: #badc58">Gift Cards</span>
            </div>
        </a>
    </div>
@stop
