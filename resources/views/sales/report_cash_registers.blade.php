@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item">Cajas</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <report-cash-registers></report-cash-registers>
    </div>
</div>
@stop
