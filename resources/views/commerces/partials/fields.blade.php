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
@if ($commerce->logo_path)
    <img src="{{  route('commerces.logo', $commerce) }} " alt="" class="img-rounded" width="150">
@else
    <img src="{{ asset('/img/picture.svg') }}" class="img-rounded" width="150" id="blah">
@endif
{!! Field::file('gift_card', ['template' => 'templates.inline']) !!}
@if ($commerce->gift_card_path)
    <img src="{{  route('commerces.gift_card', $commerce) }} " alt="" class="img-rounded" width="150">
@endif