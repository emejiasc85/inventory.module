@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Producto</li>
     <li class="breadcrumb-item active">{{ $product->name }}</li>
	 <li class="breadcrumb-item active">Detalles</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
            <div class="card">
                <div class="card-header">

                    <strong>{{ $product->name }}</strong>
                    <small>Editar</small>

                </div>

                <div class="card-block">

                    <div class="col-xs-12 col-md-4">
                        <ul class="icons-list">
                            <li>
                                <i class="icon-badge bg-primary"></i>
                                <div class="desc">
                                    <div class="title">{{ $product->make->name }}</div>
                                    <small>Marca</small>
                                </div>
                            </li>
                            <li>
                                <i class="icon-grid bg-primary"></i>
                                <div class="desc">
                                    <div class="title">{{ $product->group->name }}</div>
                                    <small>Grupo</small>
                                </div>
                            </li>
                            <li>
                                <i class="icon-badge bg-primary"></i>
                                <div class="desc">
                                    <div class="title">{{ $product->presentation->name }}</div>
                                    <small>Presentación</small>
                                </div>
                            </li>
                            <li>
                                <i class="icon-chemistry bg-primary"></i>
                                <div class="desc">
                                    <div class="title">{{ $product->unit->name }}</div>
                                    <small>Unidad de Medida</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <h3>Fotos del Producto</h3>
                        <div class="row">
                        @foreach ($product->images as $image)
                          <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                              <img src="{{ $image->img_path}}" alt="">
                              <div class="caption">
                                <p>{{ $image->description }}</p>
                                <p>
                                    <a href="#" class="btn btn-default" role="button">Eliminar</a>
                                </p>
                              </div>
                            </div>
                          </div>
                        @endforeach

                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

        </div>
	</div>
@stop


