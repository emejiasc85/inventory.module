<div class="col-xs-12">
{{ Form::model(Request::all(),['route' => ['reports.sellers'], 'method' => 'get']) }}
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
                <div class="col-sm-3">
                    {!! Field::date('from', null,  ['class' => 'form-control ']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Field::date('to', null,  ['class' => 'form-control ']) !!}
                </div>
                <div class="col-sm-2">
                    {!! Field::select('order', ['ASC' => 'ASC', 'DESC' => 'DESC'], 'DESC',  ['class' => 'form-control ']) !!}
                </div>

                <div class="col-sm-1">
                    {!! Field::select('simbol', ['=' => '=', '<' => '<', '>' => '>'],'=',  ['class' => 'form-control ']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Field::text('sales', null,  ['class' => 'form-control ']) !!}
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
</div>