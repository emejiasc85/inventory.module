@extends('layouts.base')

@section('breadcrumb')
   <li class="breadcrumb-item">Productos</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>Productos</strong>
                    <small>Listado</small>
                    <a href="{{ route('products.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Nuevo</a>
                </div>

                <div class="card-block">
                    <div class="row">
                        <div class="col-xs-5">
                          {{ Form::open(['products.index', 'method' => 'get']) }}
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
                               <th>Producto</th>
                               <th>Acciones</th>
                           </tr>
                           @foreach ($products as $product)
                               <tr>
                                   <td>{{ $product->name }}</td>
                                   <td><a href="{{ $product->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i>Editar</a></td>
                               </tr>
                           @endforeach
                       </table>
                    </div>
                    <!--/.row-->
                </div>
                <div class="card-footer">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
	</div>
@stop


