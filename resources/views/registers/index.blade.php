@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Ventas</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Ventas</strong>
                <small>Listado</small>
            </div>
            <div class="panel-body">
                @include('registers.partials.search')

                <div class="table-responsive">
                  @include('registers.partials.table')
                </div>
            </div>
            <div class="panel-footer">
                {{ $registers->links() }}
            </div>
        </div>
    </div>
</div>
@stop


