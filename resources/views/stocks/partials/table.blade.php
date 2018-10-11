<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Grupo</th>
            <th>Presentación</th>
            <th class="text-right">Existencia</th>
            <th class="text-right">Precio Venta</th>
            <th class="text-right">Precio Oferta</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
            <tr>
                <td>{{ $stock->id }}</td>
                <td><a target="_blank" href="{{ route('products.show', [$stock->id, $stock->slug]) }}">{{ $stock->name }}</a></td>
                <td>{{ $stock->make}}</td>
                <td>{{ $stock->product_group}}</td>
                <td>{{ $stock->presentation}}</td>
                <td class="text-right">{{ $stock->stock}}</td>
                <td class="text-right">{{ $stock->price}}</td>
                <td class="text-right">{{ $stock->offer_price}}</td>
            </tr>
        @endforeach
    </tbody>
</table>