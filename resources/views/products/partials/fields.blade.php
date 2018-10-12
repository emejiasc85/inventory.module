{!! Field::text('name') !!}
{!! Field::textarea('description', ['rows' => 2]) !!}
<div class="row">
    <div class="col-xs-12 col-md-6">
        {!! Field::select('category_id', $categories) !!}
    </div>
    <div class="col-xs-12 col-md-6">
        {!! Field::select('product_group_id', $groups) !!}
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
        {!! Field::select('product_serie_id', $product_series ) !!}
    </div>
    <div class="col-xs-12 col-md-6">
        {!! Field::select('unit_measure_id', $units) !!}
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
        {!! Field::select('make_id', $makes) !!}
    </div>
    <div class="col-xs-12 col-md-6">
        {!! Field::select('product_presentation_id', $presentations) !!}
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
        {!! Field::number('barcode') !!}
    </div>
    <div class="col-xs-12 col-md-6">
        {!! Field::number('minimum_stock') !!}
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
        {!! Field::checkbox('add_colors', true, false, ['id' => 'showAddColors'])!!}
    </div>
</div>
<div class="collapse" id="showColors">
    <div class="well">
            <table class="table">
                @foreach ($colors->chunk(20) as $items)
                    <tr>
                        @foreach ($items as $color)
                            <td style="background-color: {{ $color->color }}">
                                <div class="">
                                <label class="text-center">
                                <input
                                    class="color"
                                    style="width: 30px; height: 30px; margin: 0;"
                                    type="checkbox"
                                    value="{{ $color->id }}"
                                    @if (isset($product))
                                        {{ ($product->colors->where('id', $color->id)->count() >= 1)? 'checked':'' }}
                                    @endif
                                    name="color[]">
                                </label>
                            </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
    </div>
</div>
