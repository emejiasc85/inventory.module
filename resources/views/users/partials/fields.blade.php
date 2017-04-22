{!! Field::text('name', ['template' => 'templates.inline']) !!}
{!! Field::email('email', ['template' => 'templates.inline']) !!}
{!! Field::password('password', ['template' => 'templates.inline']) !!}
{!! Field::password('password_confirmation', ['template' => 'templates.inline']) !!}
{!! Field::select('role_id', $roles, null, ['template' => 'templates.inline']) !!}