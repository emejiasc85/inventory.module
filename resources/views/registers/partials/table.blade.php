<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha apertura</th>
            <th>Fecha cierra</th>
            <th>Ventas</th>
            <th>Creditos</th>
            <th>Pagos</th>
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
            <td>{{ number_format($register->sales->sum('total'),2) }}</td>
            <td>{{ number_format($register->sales->where('payment_method_id', 4)->sum('total'),2) }}</td>
            <td>{{ number_format($register->payments->sum('amount'),2) }} </td>
            <td>{{ number_format($register->Deposits->sum('amount'),2)}}</td>
            <td>{{ $register->user->name}}</td>
            <td><a href="{{ $register->editUrl }}" class="btn btn-info "> <i class="fa fa-eye"></i> Detalle</a></td>
        </tr>
        @endforeach
    </tbody>
</table>