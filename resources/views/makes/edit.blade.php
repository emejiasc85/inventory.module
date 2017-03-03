@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{ route('makes.index') }}">Marcas</a></li>
	 <li class="breadcrumb-item">{{ $make->name }}</li>
	 <li class="breadcrumb-item active">Editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i>
                    <strong>Marca {{ $make->name }}</strong>
                    <small>Editar</small>
                </div>
				{!! Form::model($make, ['route' => ['makes.update', $make ], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
							@include('makes.partials.fields')
                           @if ($make->logo_path)
                              <img src="{{  route('makes.logo', $make) }}" alt="" class="img-rounded" width="75">
                            @else
                              <img src="{{ asset('img/picture.svg') }}" alt="" class="img-rounded" width="75">
                            @endif
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


