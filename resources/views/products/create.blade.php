@extends('layouts.base')
@section('styles')
    {!! Html::style('icheck/all.css') !!}
@endsection
@section('breadcrumb')
	 <li><a href="{{ route('products.index') }}"></a>Productos</li>
	 <li>Nuevo</li>
@stop
@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-barcode"></i>
                    <strong>Productos</strong>
                    <small>Nuevo</small>
                </div>
				{!! Form::open(['route' => ['products.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @include('products.partials.fields')
                            <div class="col-xs-12">
                                <div class="row">
                                    {!! Field::checkbox('make_order', true, false, [ 'id' => 'showMakeOrderButton'])!!}
                                </div>
                                <div class="collapse" id="showMakeOrder">
                                    <div class="well">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                {!! Field::text('purchase_price', ['placeholder' => '0.00']) !!}
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                {!! Field::text('price',0, ['placeholder' => '0.00']) !!}
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                {!! Field::text('offer_price',0, ['placeholder' => '0.00']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                {!! Field::number('lot') !!}
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                {!! Field::select('people_id', $providers) !!}
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                {!! Field::date('due_date') !!}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-dot-circle-o"></i>
                        Guardar
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
    $("select").select2({
        tags: true
    });
    $('#showMakeOrderButton').click( function (e){
        $('#showMakeOrder').collapse('toggle')
    });
    $('#showAddColors').click( function (e){
        $('#showColors').collapse('toggle')
    });

    $('.color').iCheck({
        checkboxClass: 'icheckbox_flat',
        radioClass: 'iradio_flat'
    });
</script>

@endsection
