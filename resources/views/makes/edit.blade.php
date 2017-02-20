@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item">Marcas</li>
	 <li class="breadcrumb-item">{{ $make->name }}</li>
	 <li class="breadcrumb-item active">editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <strong>Marca {{ $make->name }}</strong>
                    <small>Editar</small>
                </div>
				{!! Form::model($make, ['route' => ['makes.update', $make ], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
							@include('makes.partials.fields')
                            <img src="assets/img/picture.svg" class="img-rounded" width="150" id="blah">
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


