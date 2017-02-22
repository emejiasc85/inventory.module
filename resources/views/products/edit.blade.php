@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Productos</li>
     <li class="breadcrumb-item active">{{ $product->name }}</li>
	 <li class="breadcrumb-item active">Editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $product->name }}</strong>
                    <small>Editar</small>
                </div>
				{!! Form::model($product, ['route' => ['products.update', $product], 'method' => 'PUT', 'class' => 'form-horizontal', ]) !!}
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
							@include('products.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-dot-circle-o"></i>
                        Editar
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


