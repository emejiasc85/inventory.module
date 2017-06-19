{{ Form::model(Request::all(),['route' => ['quotes.details', $order], 'method' => 'get']) }}
    <div class="row">
      <div class="col-xs-3">
        <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Cod. Barras">
      </div>
      <div class="col-xs-2">
        <input type="text" class="form-control" name="id" placeholder="ID">
      </div>
      <div class="col-xs-5">
        <input type="text" class="form-control" name="name" placeholder="Nombre">
      </div>
      <div class="col-xs-1">
          <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
      </div>
</div>

{{ Form::close() }}