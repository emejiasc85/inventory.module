<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>Pedido</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
            <tr>
                <td>{{ $stock->detail->product->id }}</td>
                <td><a href="{{ $stock->detail->product->url }}">{{ $stock->detail->product->name }}</a></td>
                <td>{{ $stock->detail->product->make->name}}</td>
                <td>{{ $stock->detail->sale_price}}</td>
                <td><span class="label label-danger">{{ $stock->stock}}</span></td>

                <td><a href="{{  $stock->detail->order->url }}">#{{ $stock->detail->order->id }}</a> </td>
            </tr>
        @endforeach
    </tbody>
</table>