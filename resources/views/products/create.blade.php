@extends('layouts.base')

@section('breadcrumb')
	 <li><a href="{{ route('products.index') }}"></a>Productos</li>
	 <li>Nuevo</li>
@stop
@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-barcode"></i>
                    <strong>Productos</strong>
                    <small>Nuevo</small>
                </div>
				{!! Form::open(['route' => ['products.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
							@include('products.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-dot-circle-o"></i>
                        Guardar
                    </button>
                    <a href="{{ URL::previous() }}" class="btn btn-link text-danger">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </a>
                </div>
				{!! Form::close() !!}
            </div>

        </div>
	</div>
@stop


