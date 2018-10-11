@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <cash_register></cash_register>
    </div>
</div>
@stop
