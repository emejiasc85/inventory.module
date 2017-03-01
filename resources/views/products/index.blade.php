@extends('layouts.base')

@section('breadcrumb')
   <li class="breadcrumb-item">Productos</li>
@stop

@section('content')

	<div class="row">
		<div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>Productos</strong>
                    <small>Listado</small>
                    <a href="{{ route('products.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Nuevo</a>
                </div>
                <div class="card-block">
                      <div class="col-xs-12">
                        @include('products.partials.search')
                      </div>
                      <br />
                      <div class="col-xs-12">
                        @include('products.partials.table')
                      </div>
                </div>
                <div class="card-footer">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
	</div>
@stop


