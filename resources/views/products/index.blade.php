@extends('layouts.base')

@section('breadcrumb')
   <li class="breadcrumb-item">Productos</li>
@stop

@section('content')

	<div class="row">
		<div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Productos</strong>
                    <small>Listado</small>
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm pull-right" style="margin-top: 5px"><span class="fa fa-plus"></span> Nuevo</a>
                </div>
                <div class="panel-body">
                      <div class="col-xs-12">
                        @include('products.partials.search')
                      </div>
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          @include('products.partials.table')
                        </div>
                      </div>
                </div>
                <div class="panel-footer">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
	</div>
@stop


