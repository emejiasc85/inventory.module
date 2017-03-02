{!! Field::text('name', ['template' => 'templates.inline', 'required']) !!}
{!! Field::textarea('description', ['template' => 'templates.inline', 'required', 'rows' => 2]) !!}
{!! Field::number('barcode', ['template' => 'templates.inline']) !!}
{!! Field::number('minimum_stock', ['template' => 'templates.inline']) !!}
{!! Field::select('make_id', $makes, ['template' => 'templates.inline', 'required']) !!}
{!! Field::select('product_presentation_id', $presentations, ['template' => 'templates.inline', 'required']) !!}
{!! Field::select('product_group_id', $groups, ['template' => 'templates.inline', 'required']) !!}
{!! Field::select('unit_measure_id', $units, ['template' => 'templates.inline', 'required']) !!}