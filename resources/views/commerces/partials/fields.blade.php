{!! Field::text('name', ['template' => 'templates.inline', 'required']) !!}
{!! Field::text('patent_name', ['template' => 'templates.inline']) !!}
{!! Field::text('patent', ['template' => 'templates.inline']) !!}
{!! Field::textarea('address', ['rows' => 2, 'template' => 'templates.inline', 'required']) !!}
{!! Field::number('phone', ['template' => 'templates.inline', 'required']) !!}
{!! Field::number('other_phone', ['template' => 'templates.inline']) !!}
{!! Field::number('nit', ['template' => 'templates.inline']) !!}
{!! Field::text('tax', ['template' => 'templates.inline']) !!}
{!! Field::text('profit', ['template' => 'templates.inline']) !!}
{!! Field::file('logo', ['template' => 'templates.inline']) !!}