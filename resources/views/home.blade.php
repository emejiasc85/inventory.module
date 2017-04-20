@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-sm-6 col-xs-6 col-xs-12">
            <a  href="{{ route('bills.create') }}">
                <div class="smallstat">
                    <i class="fa fa-shopping-cart primary"></i>
                    <span class="value text-primary">Facturar</span>
                </div><!--/.smallstat-->
            </a>
        </div><!--/.col-->
    </div>
</div>
@stop
