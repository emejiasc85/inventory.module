<div class="col-xs-12">
{{ Form::model(Request::all(),['route' => ['stocks.index'], 'method' => 'get']) }}
    <div class="controls">
        <div class="input-group">
            <input id="name" name="name" size="16" class="form-control" type="text">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
                <a class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-filter"></i>
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
                    {!! Field::select('make_id', $makes, null, ['style' => 'width:100% !important']) !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::select('product_presentation_id', $presentations, null, ['style' => 'width:100% !important']) !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::select('product_group_id', $groups, null, ['style' => 'width:100% !important']) !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::select('unit_measure_id', $units, null, ['style' => 'width:100% !important']) !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::date('from_due', null,  ['class' => 'form-control ']) !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::date('to_due', null,  ['class' => 'form-control ']) !!}
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-sm-1">
                            {!! Field::select('simbol', ['=' => '=', '<' => '<', '>' => '>'],null,  ['class' => 'form-control ']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Field::text('stock', null,  ['class' => 'form-control ', 'placeholder' => '5']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
</div>