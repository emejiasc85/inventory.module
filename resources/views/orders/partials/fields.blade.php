{!! Field::select('order_type_id', $types,  ['template' => 'templates.inline']) !!}
{!! Field::select('provider_id', $providers, ['template' => 'templates.inline']) !!}
{!! Form::radios('priority', ['Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja' ]) !!}
{!! Field::hidden('commerce_id', $commerce->id) !!}

