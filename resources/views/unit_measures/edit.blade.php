@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item">Herramientas</li>
     <li class="breadcrumb-item">Unidades de Medida</li>
	 <li class="breadcrumb-item">{{ $unit->name }}</li>
	 <li class="breadcrumb-item active">editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <strong>Unidad {{ $unit->name }}</strong>
                    <small>Editar</small>
                </div>
				{!! Form::model($unit, ['route' => ['unit.measures.update', $unit ], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
							@include('unit_measures.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
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


