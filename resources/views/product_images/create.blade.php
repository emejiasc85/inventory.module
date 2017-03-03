@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
	 <li class="breadcrumb-item"><a href="{{ $product->url }}">{{ $product->name }}</a></li>
	 <li class="breadcrumb-item ">Nueva Imagen</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs 12 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default" style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-image"></i>
                    <strong>Imagen de Producto</strong>
                    <small>Nueva</small>
                </div>
				{!! Form::open(['route' => ['product.images.store', $product], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
							@include('product_images.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-dot-circle-o"></i>
                        Agregar
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


