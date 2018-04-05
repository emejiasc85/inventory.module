@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('people.index') }}">Top clientes</a></li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Clientes</strong>
                <small>top</small>
                <a href="{{ route('reports.customers.download', Request::all()) }}" class="btn btn-default pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-download"></span></a>
            </div>
            <div class="panel-body">
                {{--
                @include('people.partials.search')
                --}}
                <div class="table-resposive">
                    @include('reports.partials.table_top_customers')
                </div>
            </div>
            <div class="panel-footer">
            {{ $people->links() }}
            </div>
        </div>
    </div>
</div>
@stop


