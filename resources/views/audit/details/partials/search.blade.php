{{ Form::model(Request::all(), ['route' => ['auditDetail.create', $audit], 'method' => 'get']) }}
  <div class="col-xs-12">
  <div class="controls">
      <div class="input-group">
          <input id="name" name="name" size="16" class="form-control" type="text">
          <span class="input-group-btn">
              <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
          </span>
      </div>
  </div>
    <br/>
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
    </div>
  </div>
  {{ Form::close() }}