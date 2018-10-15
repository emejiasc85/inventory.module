@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item">Productos</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
       <products></products>
    </div>
</div>
@stop
