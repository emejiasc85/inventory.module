
{{ Form::model(Request::all(),['route' => ['people.index'], 'method' => 'get']) }}
    <div class="controls">
        <div class="input-group">
            <input id="name" name="name" size="16" class="form-control" type="text">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
                <a class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-filter"></i>
                </a>
                <a href="{{ route('people.download', Request::all())}}" class="btn btn-default">
                    <i class="fa fa-download"></i>
                </a>
            </span>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="well">
            <div class="row ">
                <div class="col-sm-3">
                    {!! Field::text('nit') !!}
                </div>
                <div class="col-sm-3">
                    {!! Field::text('id') !!}
                </div>

                <div class="col-xs-3">
                    {!! Field::checkbox('partner')!!}
                    {!! Field::checkbox('credit')!!}
                </div>
                <div class="col-xs-3">
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}