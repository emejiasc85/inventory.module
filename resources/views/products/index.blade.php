@extends('layouts.base')

@section('breadcrumb')
   <li class="breadcrumb-item">Productos</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
            <div class="card row">
                <div class="card-header">
                    <strong>Productos</strong>
                    <small>Listado</small>
                    <a href="{{ route('products.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Nuevo</a>
                </div>

                <div class="card-block">
                        <div class="col-xs-5">
                          {{ Form::open(['products.index', 'method' => 'get']) }}
                           <div class="form-group row">
                              <div class="col-md-12">
                                  <div class="input-group">
                                      <input type="text" id="name" name="name" class="form-control" placeholder="Buscar producto">
                                      <span class="input-group-btn">
                                          <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Buscar</button>
                                      </span>
                                  </div>
                              </div>
                          </div>
                          {{ Form::close() }}
                        </div>

                      @include('products.partials.table')

                </div>
                <div class="card-footer">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
	</div>
@stop


