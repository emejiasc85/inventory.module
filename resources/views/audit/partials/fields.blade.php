{!! Field::select('user_id', $users) !!}
{!! Field::checkbox('type', true, true, ['label' => "Auditar existencias"]) !!}
{!! Field::hidden('commerce_id', $commerce->id) !!}