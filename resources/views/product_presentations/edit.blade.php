@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Herramientas</li>
     <li class="breadcrumb-item active">Productos</li>
     <li class="breadcrumb-item active">Presentación</li>
     <li class="breadcrumb-item active">{{ $presentation->name }}</li>
	 <li class="breadcrumb-item active">Editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $presentation->name }}</strong>
                    <small>Editar</small>
                </div>
				{!! Form::model($presentation, ['route' => ['product.presentations.update', $presentation], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
							@include('product_groups.partials.fields')
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


