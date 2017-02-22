{!! Field::text('name') !!}
{!! Field::number('description') !!}
{!! Field::number('barcode') !!}
{!! Field::number('minimum_stock') !!}
{!! Field::select('product_presentation_id', $presentations, []) !!}
{!! Field::select('product_group_id', $groups) !!}
{!! Field::select('unit_measure_id', $units) !!}