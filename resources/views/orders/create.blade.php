@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Ordenes</a></li>
	 <li class="breadcrumb-item active">Nueva</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-list-ol"></i>
                    <strong>Orden</strong>
                    <small>Nuevo</small>
                </div>
				{!! Form::open(['route' => ['orders.store'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
							@include('orders.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                <div id="buttons">
                    <button  type="submit" class="btn btn-primary" onClick="siguiente()">
                        Siguiente
                        <i class="fa fa-angle-double-right "></i>
                    </button>

                    <a href="{{ URL::previous() }}" class="btn btn-link text-danger">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </a>
                </div>
                    <div class="row " id="spiner" style="display: none">
                        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
				{!! Form::close() !!}
            </div>

        </div>
	</div>
    <script type="text/javascript" >
        function siguiente(){
            $("#buttons").fadeOut(1);
            $("#spiner").fadeIn(1);
        }
    </script>
@stop


