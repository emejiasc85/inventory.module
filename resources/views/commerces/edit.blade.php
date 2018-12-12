@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item">Herramientas</li>
     <li class="breadcrumb-item active">Configuración</li>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <i class="icon-home"></i>
                    <strong>{{ $commerce->name }}</strong>
                    <small>Editar</small>
                </div>
                {!! Form::model($commerce, ['route' => ['commerces.update', $commerce], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @include('commerces.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-pencil"></i>
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
@endsection
