<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><a href="{{ $product->url}}">{{ $product->name }}</a></td>
                <td>{{ $product->cant }}</td>
            </tr>
        @endforeach
    </tbody>
</table>