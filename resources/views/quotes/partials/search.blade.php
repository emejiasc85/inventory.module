{{ Form::model(Request::all(),['route' => ['quotes.details', $order], 'method' => 'get']) }}
    <div class="col-sm-4">
        <input type="text" name="barcode" class="form-control" placeholder="Cod. Barras">
    </div>
    <div class="col-sm-2">
        <input type="text" name="id" class="form-control" placeholder="ID">
    </div>
    <div class="col-sm-5">
        <input type="text" name="name" class="form-control" placeholder="Nombre">
    </div>
    <div class="col-sm-1">
        <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span></button>
    </div>
{{ Form::close() }}