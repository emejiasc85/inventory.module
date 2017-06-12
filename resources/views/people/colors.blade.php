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
                    <small>Editar Colores </small>
                </div>
                {!! Form::model($people, ['route' => ['people.update.colors', $people], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                <div class="panel-body">
                    <div class="row well">
                        <div class="col-sm-12">
                                @foreach ($colors as $color)
                                    {{-- expr --}}
                                    <div class="col-sm-3">
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" value="{{ $color->id }}" {{ ($people->colors->where('id', $color->id)->count() >= 1)? 'checked':'' }} name="color[]"> <span class="fa fa-circle" style="color: {{ $color->color }} ; font-size: 1.5em"></span>
                                        </label>
                                      </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
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


