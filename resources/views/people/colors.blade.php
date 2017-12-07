@extends('layouts.base')
@section('styles')
    {!! Html::style('icheck/all.css') !!}
@endsection
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
                    <div class="table-responsive">
                        <table class="table">
                            @foreach ($colors->chunk(5) as $items)
                                <tr>
                                    @foreach ($items as $color)
                                        <td style="background-color: {{ $color->color }}">
                                            <div class="">
                                            <label class="text-center">
                                              <input
                                                style="width: 30px; height: 30px; margin: 0;"
                                                type="checkbox"
                                                value="{{ $color->id }}" {{ ($people->colors->where('id', $color->id)->count() >= 1)? 'checked':'' }}
                                                name="color[]">
                                            </label>
                                          </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
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

@section('scripts')
    {!! Html::script('icheck/icheck.js') !!}

<script>
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat',
    radioClass: 'iradio_flat'
  });
});
</script>
@endsection


