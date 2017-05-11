<div class="row">
    <div class="col-xs-12">
    {{ Form::model(Request::all(), ['route' => ['bills.index'], 'method' => 'get']) }}
        <div class="controls">
            <div class="input-group">
                <input id="name" name="people_name" size="16" class="form-control" type="text" placeholder="Cliente">
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
                    <div class="col-sm-2">
                        {!! Field::number('bill_id') !!}
                    </div>
                    <div class="form-group col-lg-3">
                        {!! Form::label('from', 'Desde') !!}
                        {!! Form::date('from', null,  ['class' => 'form-control ']) !!}
                    </div>
                    <div class="form-group col-lg-3">
                        {!! Form::label('to', 'Hasta') !!}
                        {!! Form::date('to', null,  ['class' => 'form-control ']) !!}
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
    </div>

</div>