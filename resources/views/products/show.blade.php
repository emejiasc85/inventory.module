@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Producto</li>
     <li class="breadcrumb-item active">{{ $product->name }}</li>
	 <li class="breadcrumb-item active">Detalles</li>
@stop

@section('content')
	<div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="panel panel-default" style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-bookmark-o"></i>
                    <strong>{{ $product->name }}</strong>
                    <small>Detalles</small>
                    <a title="Editar" href="{{ $product->editUrl }}" class="btn btn-success btn-sm pull-right" style="margin-top: 5px"><span class="fa fa-pencil"></span></a>
                </div>
                <div class="panel-body">
                    <p>
                        {{ $product->description }}
                    </p>
                    <ul class="list">
                        <li>
                            <p>
                                <span class="icon-badge"></span>
                                <strong>Marca:</strong>
                                {{ $product->make->name }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="icon-grid"></span>
                                <strong>Grupo:</strong>
                                {{ $product->group->name }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="icon-tag"></span>
                                <strong>Presentación:</strong>
                                {{ $product->presentation->name }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="icon-chemistry"></span>
                                <strong>Medida:</strong>
                                {{ $product->unit->name }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-8">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-image"></i>
                    <strong>Imagenes</strong>
                    <a title="agregar" href="{{ $product->addImgUrl }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px">
                        <span class="fa fa-plus"></span>
                    </a>
                </div>
                <div class="panel-body">
                    @if ($product->images)
                        @foreach ($product->images as $image)

                                  <div class="col-xs-4">
                                    <div class="thumbnail">
                                      <img src="{{ route('product.images.img', $image) }}" alt="...">
                                      <div class="caption">
                                        <p>{{ $image->description }}</p>
                                        <p><a href="#" class="btn btn-danger btn-xs" role="button"><span class="fa fa-asterisk"></span></a></p>
                                      </div>
                                    </div>
                                  </div>
                        @endforeach
                        {{-- expr --}}
                    @endif

                </div>

            </div>
        </div>
	</div>
@stop


