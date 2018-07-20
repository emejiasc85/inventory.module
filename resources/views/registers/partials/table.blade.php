<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha apertura</th>
            <th>Fecha cierra</th>
            <th>Venta</th>
            <th>Pagos</th>
            <th>Creditos</th>
            <th>Depositos</th>
            <th>usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($registers as $register)
        <tr>
            <td>{{ $register->id }}</td>
            <td>{{ $register->created_at }}</td>

            <td>
            @if($register->status)
                {{ $register->closing_date }}
            @endif
            </td>
            <td>{{ $register->sales->sum('total')}}</td>
            <td>{{ $register->sales->sum('total')}}</td>
            <td>{{ $register->payments->sum('amount')}}</td>
            <td>{{ $register->credits->sum('total')}}</td>
            <td>{{ $register->user->name}}</td>
            <td><a href="{{ $register->editUrl }}" class="btn btn-info "> <i class="fa fa-eye"></i> Detalle</a></td>
        </tr>
        @endforeach
    </tbody>
</table>