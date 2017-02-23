{{ Form::open(['products.index', 'method' => 'get']) }}
 <div class="form-group row">
    <div class="col-md-11">
        <div class="input-group">
            <input type="text" id="name" name="name" class="form-control" placeholder="Buscar producto">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Buscar</button>
            </span>
        </div>

    </div>

    <div class="col-xs-1">
      <button type="button" class="btn btn-outline-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-filter"></i></button>
    </div>
</div>

<div class="collapsing" id="collapseExample">
  <div class="row">
      <div class="col-sm-4">
        {!! Field::text('barcode') !!}
      </div>
      <div class="col-sm-4">
        {!! Field::text('id') !!}
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
  </div>
</div>
{{ Form::close() }}
