@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Caja</a></li>
    <li class="breadcrumb-item">Venta</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <invoice></invoice>
    </div>
</div>
@stop
