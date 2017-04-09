<div class="row">
    <div class="col-xs-12">
    {{ Form::open(['route' => ['orders.index'], 'method' => 'get']) }}
        <div class="controls">
            <div class="input-group">
                <input id="name" name="id" size="16" class="form-control" type="text">
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
                    <div class="col-sm-3">
                        {!! Field::select('priority', config('helpers.priority')) !!}
                    </div>

                    <div class="col-sm-3">
                        {!! Field::select('status', config('helpers.order_status')) !!}
                    </div>

                    <div class="form-group col-lg-3">
                        {!! Form::label('from', 'Desde') !!}
                        {!! Form::date('from', null,  ['class' => 'form-control ']) !!}
                    </div>
                    <div class="form-group col-lg-3">
                        {!! Form::label('to', 'Hasta') !!}
                        {!! Form::date('to', null,  ['class' => 'form-control ']) !!}
                    </div>
                    <div class="col-xs-12">
                    <div class="row">
                        <div class="form-group col-lg-1">
                            {!! Form::label('simbol', 'Selector') !!}
                            {!! Form::select('simbol', ['=' => '=', '<' => '<', '>' => '>'],null,  ['class' => 'form-control ']) !!}
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('total', 'Total') !!}
                            {!! Form::text('total', null,  ['class' => 'form-control ']) !!}
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
    </div>

</div>