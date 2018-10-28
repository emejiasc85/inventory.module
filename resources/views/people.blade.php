@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item">Personas</li>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <people people_id="{{ request()->id }}"></people>
        </div>
    </div>
@stop
