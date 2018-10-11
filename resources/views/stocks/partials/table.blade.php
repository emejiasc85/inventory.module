<table class="table table-striped">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Grupo</th>
            <th class="text-center">Serie</th>
            <th class="text-center">Medida</th>
            <th>Presentación</th>
            <th class="text-center">Existencia</th>
            <th class="text-right">Precio Venta</th>
            <th class="text-right">Precio Oferta</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
            <tr>
                <td class="text-center">{{ $stock->id }}</td>
                <td><a target="_blank" href="{{ route('products.show', [$stock->id, $stock->slug]) }}">{{ $stock->name }}</a></td>
                <td>{{ $stock->make}}</td>
                <td>{{ $stock->product_group}}</td>
                <td class="text-center">{{ $stock->serie}}</td>
                <td class="text-center">{{ $stock->unit}}</td>
                <td>{{ $stock->presentation}}</td>
                <td class="text-center">{{ $stock->stock}}</td>
                <td class="text-right">{{ $stock->price}}</td>
                <td class="text-right">{{ $stock->offer_price}}</td>
            </tr>
        @endforeach
    </tbody>
</table>