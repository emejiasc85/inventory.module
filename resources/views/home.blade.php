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
        <a  href="{{ route('bills.create') }}">
            <div class="smallstat">
                <i class="fa fa-shopping-cart primary"></i>
                <span class="value text-primary">Facturar</span>
            </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{ route('quotes.create') }}">
            <div class="smallstat">
                <i class="fa fa-calendar primary" style="background-color: #008B8B"></i>
                <span class="value" style="color: #008B8B">Cotizar</span>
            </div><!--/.smallstat-->
        </a>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{ route('stocks.index') }}">
            <div class="smallstat">
                <i class="fa fa-cubes info"></i>
                <span class="value text-info">Existencias</span>
            </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{ route('bills.index') }}">
            <div class="smallstat">
                <i class="fa fa-inbox success"></i>
                <span class="value text-success">Ventas</span>
            </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{ route('orders.index') }}">
            <div class="smallstat">
                <i class="fa fa-truck warning" style="background-color: #FF8C00"></i>
                <span class="value" style="color: #FF8C00">Pedidos</span>
            </div><!--/.smallstat-->
        </a>
    </div>
    <!--/.co
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xs-12">
        <a  href="{{-- route('audit.index') --}}">
            <div class="smallstat">
                <i class="fa fa-list-alt danger"></i>
                <span class="value text-danger">Auditoria</span>
            </div>
        </a>
    </div><!--/.col-->
@stop
