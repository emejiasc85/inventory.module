@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Productos</li>
	 <li class="breadcrumb-item active">Nuevo</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <strong>Productos</strong>
                    <small>Nuevo</small>
                </div>
				{!! Form::open(['route' => ['products.store'], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
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


