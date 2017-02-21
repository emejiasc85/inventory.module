@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Marcas</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>Marcas</strong>
                    <small>Listado</small>
                    <a href="{{ route('makes.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Nuevo</a>
                </div>

                <div class="card-block">
                    <div class="row">
                        <div class="col-xs-5">
                          {{ Form::open(['makes.index', 'method' => 'get']) }}
                           <div class="form-group row">
                              <div class="col-md-12">
                                  <div class="input-group">
                                      <input type="text" id="name" name="name" class="form-control" placeholder="Buscar marca">
                                      <span class="input-group-btn">
                                          <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>Buscar</button>
                                      </span>
                                  </div>
                              </div>
                          </div>
                          {{ Form::close() }}
                        </div>

                        <table class="table col-sm-12">
                           <tr>
                               <th></th>
                               <th>Marca</th>
                               <th>Acciones</th>
                           </tr>
                           @foreach ($makes as $make)
                               <tr>
                                   <td><img src="{{  route('makes.logo', $make) }}" alt="" class="img-rounded" width="50"></td>
                                   <td>{{ $make->name }}</td>
                                   <td><a href="{{ $make->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i>Editar</a></td>
                               </tr>
                           @endforeach
                       </table>
                    </div>
                    <!--/.row-->
                </div>
                <div class="card-footer">
                    {{ $makes->links() }}
                </div>
            </div>

        </div>
	</div>
@stop


