@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item"><a href="">Ordenes</a></li>
	 <li class="breadcrumb-item">orden #{{ $order->id }}</li>
	 <li class="breadcrumb-item active">Editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i>
                    <strong>Orden # {{ $order->id }}</strong>
                    <small>Editar</small>
                </div>
				{!! Form::model($order, ['route' => ['orders.update', $order ], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
							@include('orders.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-pencil"></i>
                        Siguiente
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


