<table class="table col-sm-12">
    <tr >
        <th>ID</th>
        <th>Nit</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th class="text-center">Socio</th>
        <th class="text-right">Consumo</th>
        <th class="text-right">Credito</th>        
    </tr>
    @foreach ($people as $person)
    <tr>
        <td><a href="{{ $person->profileUrl }}">{{ $person->id }}</a></td>
        <td>{{ $person->nit }}</td>
        <td>{{ $person->name}}</td>
        <td>{{ ($person->type =='provider')  ? 'Proveedor':'Cliente'}}</td>
        <td class="text-center">
        @if($person->partner)
            <i class="fa fa-check text-success"></i>
        @endif
        </td>
        <td class="text-right">{{ $person->total - $person->credit}}</td>
        <td class="text-right">{{ $person->credit}}</td>
    </tr>
    @endforeach
</table>