@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item">Producto</li>
	 <li class="breadcrumb-item">{{ $product->name }}</li>
	 <li class="breadcrumb-item active">Nueva Imagen</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <strong>Imagenes de Productos</strong>
                    <small>Nueva</small>
                </div>
				{!! Form::open(['route' => ['product.images.store', $product], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
							@include('product_images.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="card-footer">
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


