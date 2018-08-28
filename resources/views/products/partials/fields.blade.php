{!! Field::text('name', ['template' => '', 'required']) !!}
{!! Field::textarea('description', ['template' => '', 'rows' => 2]) !!}
<div class="row">
    <div class="col-xs-12 col-md-6">
        {!! Field::select('category_id', $categories, ['template' => '', 'required']) !!}
    </div>
    <div class="col-xs-12 col-md-6">
        {!! Field::select('product_group_id', $groups, ['template' => '', 'required']) !!}
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
        {!! Field::select('serie_id', $groups, ['template' => '', 'required']) !!}
    </div>
    <div class="col-xs-12 col-md-6">
        {!! Field::select('unit_measure_id', $units, ['template' => '', 'required']) !!}
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
        {!! Field::select('make_id', $makes, ['template' => '', 'required']) !!}
    </div>
    <div class="col-xs-12 col-md-6">
        {!! Field::select('product_presentation_id', $presentations, ['template' => '', 'required']) !!}
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-md-6">
        {!! Field::number('barcode', ['template' => '']) !!}
    </div>
    <div class="col-xs-12 col-md-6">
        {!! Field::number('minimum_stock', ['template' => '']) !!}
    </div>
</div>

</div>
