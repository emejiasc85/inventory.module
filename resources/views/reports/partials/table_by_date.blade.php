<table class="table">
    <thead>
        <tr>
            <td>Fecha</td>
            <th>ID</th>
            <th>Producto</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $product->date)->format('d-m-Y') }}</td>
                <td>{{ $product->id }}</td>
                <td><a href="{{ $product->url}}">{{ $product->name }}</a></td>
                <td>{{ $product->cant }}</td>
            </tr>
        @endforeach
    </tbody>
</table>