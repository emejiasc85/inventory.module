@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item">Herramientas</li>
     <li class="breadcrumb-item active"><a href="{{ route('unit.measures.index') }}">Unidades de Medida</a></li>
	 <li class="breadcrumb-item">{{ $unit->name }}</li>
	 <li class="breadcrumb-item active">editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i>
                    <strong>Unidad {{ $unit->name }}</strong>
                    <small>Editar</small>
                </div>
				{!! Form::model($unit, ['route' => ['unit.measures.update', $unit ], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
							@include('unit_measures.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-pencil"></i>
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


