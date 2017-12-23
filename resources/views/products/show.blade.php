@extends('layouts.base') @section('breadcrumb')
<li class="breadcrumb-item">Producto</li>
<li class="breadcrumb-item active">{{ $product->name }}</li>
<li class="breadcrumb-item active">Detalles</li>
@stop @section('content')
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
                            <strong>Marca:</strong> {{ $product->make->name }}
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="icon-grid"></span>
                            <strong>Grupo:</strong> {{ $product->group->name }}
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="icon-tag"></span>
                            <strong>Presentación:</strong> {{ $product->presentation->name }}
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="icon-chemistry"></span>
                            <strong>Medida:</strong> {{ $product->unit->name }}
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="fa fa-money"></span>
                            <strong>Precio Venta:</strong> Q. {{ $product->price }}
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="fa fa-barcode"></span>
                            <strong>barcode:</strong> {{ $product->barcode }}
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <div id="bcTarget">
                                        {{ $product->barcode }}
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="{{ route('barcode.products',$product->id) }}" class="btn btn-info " target="_blank" >
                                    <span class="fa  fa-2x fa-print"></span></a>
                                </div>
                            </div>
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
                @if ($product->images) @foreach ($product->images as $image)
                <div class="col-xs-4">
                    <div class="thumbnail">
                        <img src="{{ route('product.images.img', $image) }}" alt="...">
                        <div class="caption">
                            <p>{{ $image->description }}</p>
                            <p><a href="#" class="btn btn-danger btn-xs destroy-value" data-id="{{ $image->id}}" title="Eliminar"><i class="glyphicon glyphicon-trash"></i> Eliminar</a></p>
                        </div>
                    </div>
                </div>
                @endforeach {{-- expr --}} @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alerta</h4>
            </div>
            <div class="modal-body">
                <p>Una vez eliminando no podra acceder a esta imagen</p>
                <p>¿De veras quieres eliminarlo?</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['method' => 'DELETE', 'route' => ['product.images.delete'], 'id' => 'destroyValue']) !!} {!! Form::hidden('id', null, ['id' => 'value_id']) !!}
                <button type="button" id="delete" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
{!! Html::script('js/jquery-barcode.min.js') !!}
<script>
$("#bcTarget").barcode("{{ $product->barcode }}", "code39", {barWidth:1});
$('.destroy-value').click(function(e) {
    e.preventDefault();

    var link = $(this)
    var value = link.data('id');
    var input_value = $('#value_id');

    input_value.val(value);

    $('#confirmDelete').modal('toggle');
});
</script>
@endsection
