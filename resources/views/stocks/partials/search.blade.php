<div class="col-xs-12">
{{ Form::open(['route' => ['stocks.index'], 'method' => 'get']) }}
    <div class="controls">
        <div class="input-group">
            <input id="name" name="name" size="16" class="form-control" type="text">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
                <a class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-filter">
                    </i>
                </a>
            </span>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="well">
            <div class="row ">
                <div class="col-sm-4">
                    {!! Field::text('barcode') !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::text('id') !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::select('make_id', $makes) !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::select('product_presentation_id', $presentations) !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::select('product_group_id', $groups) !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::select('unit_measure_id', $units) !!}
                </div>
                <div class="form-group col-lg-4">
                    {!! Form::label('from_due', 'vence desde') !!}
                    {!! Form::date('from_due', null,  ['class' => 'form-control ']) !!}
                </div>
                <div class="form-group col-lg-4">
                    {!! Form::label('to_due', 'vence hasta') !!}
                    {!! Form::date('to_due', null,  ['class' => 'form-control ']) !!}
                </div>
                <div class="col-xs-12">
                <div class="row">
                    <div class="form-group col-lg-1">
                        {!! Form::label('simbol', 'Selector') !!}
                        {!! Form::select('simbol', ['=' => '=', '<' => '<', '>' => '>'],null,  ['class' => 'form-control ']) !!}
                    </div>
                    <div class="form-group col-lg-1">
                        {!! Form::label('stock', 'Existencia') !!}
                        {!! Form::text('stock', null,  ['class' => 'form-control ', 'placeholder' => '5']) !!}
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
</div>