@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/sales/cash-register">Caja</a></li>
    <li class="breadcrumb-item">Venta</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <invoice invoice_id="{{ request()->id }}" people_id="{{ request()->people_id }}"></invoice>
    </div>
</div>
@stop
