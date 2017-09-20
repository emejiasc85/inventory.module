@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item active"><a href="{{ route('people.index') }}">Personas</a></li>
     <li class="breadcrumb-item active"><a href="{{ $people->profileUrl }}">{{ $people->name }}</a></li>
     <li class="breadcrumb-item active">Editar colores</li>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2" >
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i>
                    <strong>{{ $people->name }}</strong>
                    <small>Editar tags </small>
                </div>
                {!! Form::open( ['route' => ['people.update.tags', $people], 'method' => 'PUT']) !!}
                <div class="panel-body">
                    {!! Field::selectMultiple('tags[]', $tags, $people->tags_Id, ['label' => 'Etiquetas', 'id' => 'tags']) !!}
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-pencil"></i>
                        Guardar Cambios
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
        $(document).ready(function() {
            $('#tags').select2({
                tags: true,
                tokenSeparators: [',']
            });
        });
    </script>
@endsection


