@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Herramientas</li>
	 <li class="breadcrumb-item active">Configuración</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $commerce->name }}</strong>
                    <small>Editar</small>
                </div>
				{!! Form::model($commerce, ['route' => ['commerces.update', $commerce], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
							@include('commerces.partials.fields')
							@if ($commerce->logo_path)
                                <img src="{{  route('commerces.logo', $commerce) }} " alt="" class="img-rounded" width="150" id="blah">
                            @endif
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

@section('scripts')
    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#logo").change(function(){
                readURL(this);
            });
            // body...
        });


    </script>
@stop

