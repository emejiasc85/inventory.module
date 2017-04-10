{!! Field::select('type', config('helpers.people_types'),['template' => 'templates.inline']) !!}
{!! Field::number('nit', ['template' => 'templates.inline']) !!}
{!! Field::text('name', ['template' => 'templates.inline']) !!}
{!! Field::textarea('address', ['template' => 'templates.inline', 'rows' => 2]) !!}
{!! Field::email('email', ['template' => 'templates.inline']) !!}
{!! Field::number('phone', ['template' => 'templates.inline']) !!}