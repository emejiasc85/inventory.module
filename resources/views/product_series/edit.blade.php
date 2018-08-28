@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Herramientas</li>
     <li class="breadcrumb-item active"><a href="{{ route('product_series.index') }}">Series</a></li>
     <li class="breadcrumb-item active">{{ $product_series->name }}</li>
	 <li class="breadcrumb-item active">Editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2" >
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i>
                    <strong>{{ $product_series->name }}</strong>
                    <small>Editar serie</small>
                </div>
				{!! Form::model($product_series, ['route' => ['product_series.update', $product_series], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
							@include('product_series.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Guardar cambios
                    </button>
                    <a href="{{ route('product_series.index') }}" class="btn btn-link text-danger">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </a>
                </div>
				{!! Form::close() !!}
            </div>

        </div>
	</div>
@stop
