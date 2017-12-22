
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
                <div class="col-sm-4">
                    {!! Field::text('nit') !!}
                </div>
                <div class="col-sm-4">
                    {!! Field::text('id') !!}
                </div>
                {{--
                    <div class="col-xs-4">
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Field::select('simbol', ['=' => '=', '<' => '<', '>' => '>'],null,  ['class' => 'form-control ']) !!}
                            </div>
                            <div class="col-sm-8">
                                {!! Field::text('credit', null,  ['class' => 'form-control ', 'placeholder' => '300']) !!}
                            </div>
                        </div>
                    </div>
                --}}
                <div class="col-xs-4">
                    {!! Field::checkbox('partner')!!}
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}