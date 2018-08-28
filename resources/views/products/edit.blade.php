@extends('layouts.base')
@section('styles')
    {!! Html::style('icheck/all.css') !!}
@endsection
@section('breadcrumb')
	 <li><a href="{{ route('products.index') }}">Productos</a></li>
     <li><a href="{{ $product->url }}">{{ $product->name }}</a></li>
	 <li>Editar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i>
                    <strong>{{ $product->name }}</strong>
                    <small>Editar</small>
                </div>
				{!! Form::model($product, ['route' => ['products.update', $product], 'method' => 'PUT', 'class' => 'form-horizontal', ]) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @include('products.partials.fields')

                            <div class="col-xs-12 col-md-6">
                                {!! Field::text('price',null, ['placeholder' => '0.00']) !!}
                            </div>
                            <div class="col-xs-12 col-md-6">
                                {!! Field::text('offer_price',null, ['placeholder' => '0.00']) !!}
                            </div>
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-dot-circle-o"></i>
                        Editar
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
    $('#showAddColors').click( function (e){
        $('#showColors').collapse('toggle')
    });

    $('.color').iCheck({
        checkboxClass: 'icheckbox_flat',
        radioClass: 'iradio_flat'
    });
</script>

@endsection
