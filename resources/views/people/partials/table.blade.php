<table class="table col-sm-12">
    <tr>
        <th>ID</th>
        <th>Nit</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Tipo</th>
        <th>Socio</th>
        <th>Consumo</th>
        <th>Credito</th>
        <th>Crédito Máximo</th>
        <th></th>
    </tr>
    @foreach ($people as $person)
    <tr>
        <td>{{ $person->id }}</td>
        <td>{{ $person->nit }}</td>
        <td>{{ $person->name}}</td>
        <td>{{ $person->address}}</td>
        <td>{{ $person->email}}</td>
        <td>{{ $person->phone}}</td>
        <td>{{ ($person->type =='provider')  ? 'Proveedor':'Cliente'}}</td>
        <td>
        @if($person->partner)
            <i class="fa fa-check text-success"></i>
        @endif
        </td>
        <td>{{ $person->purchases->sum('total')}}</td>
        <td>{{ $person->currentCredit}}</td>
        <td>{{ $person->max_credit }}</td>
        <td><a href="{{ $person->profileUrl }}" class="btn btn-info "> <i class="fa fa-eye"></i>  Perfil</a></td>
    </tr>
    @endforeach
</table>