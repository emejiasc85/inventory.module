@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('people.index') }}">Personas</a></li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Personas</strong>
                <small>Listado</small>
                <a href="{{ route('people.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Persona</a>
            </div>
            <div class="panel-body">
                {{ Form::model(Request::all(),['people.index', 'method' => 'get']) }}
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Buscar">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>Buscar</button>
                            </span>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <div class="table-resposive">
                    @include('people.partials.table')
                </div>
            </div>
            <div class="panel-footer">
            {{ $people->links() }}
            </div>
        </div>
    </div>
</div>
@stop


