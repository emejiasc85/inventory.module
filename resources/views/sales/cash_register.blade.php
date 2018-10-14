@extends('layouts.base')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <cash-register cash_register_id="{{ request()->id}}"></cash-register>
    </div>
</div>
@stop
