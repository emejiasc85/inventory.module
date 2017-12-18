{!! Field::select('type', config('helpers.people_types'),['template' => 'templates.inline']) !!}

<fieldset>
    <legend>Datos de facturación</legend>
    {!! Field::number('nit', ['template' => 'templates.inline']) !!}
    {!! Field::text('name', ['template' => 'templates.inline']) !!}
    {!! Field::textarea('address', ['template' => 'templates.inline', 'rows' => 2]) !!}
    {!! Field::checkbox('partner', null, ['template' => 'templates.inline']) !!}
    {!! Field::text('max_credit', ['template' => 'templates.inline']) !!}
</fieldset>
<fieldset>
    <legend>Datos de personales</legend>
    {!! Field::email('email', ['template' => 'templates.inline']) !!}
    {!! Field::number('phone', ['template' => 'templates.inline']) !!}
    {!! Field::text('other_phone', ['template' => 'templates.inline']) !!}
    {!! Field::date('birthday', ['template' => 'templates.inline']) !!}
    {!! Field::radios('gender', config('helpers.gender'), 'f', ['template' => 'templates.inline']) !!}
    {!! Field::file('file', ['template' => 'templates.inline']) !!}
</fieldset>
<fieldset>
    <legend>Redes</legend>
    {!! Field::text('facebook', ['template' => 'templates.inline']) !!}
    {!! Field::text('instagram', ['template' => 'templates.inline']) !!}
    {!! Field::url('website', ['template' => 'templates.inline']) !!}
</fieldset>