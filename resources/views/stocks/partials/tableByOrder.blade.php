<table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Marca</th>
                <th>Grupo</th>
                <th>Serie</th>
                <th>Medida</th>
                <th>Presentación</th>
                <th class="text-right">Existencia</th>
                <th class="text-right">Precio Venta</th>
                <th class="text-right">Precio Compra</th>
                <th>Vence</th>
                <th >Pedido</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td><a target="_blank" href="{{ route('products.show', [$stock->id, $stock->slug]) }}">{{ $stock->name }}</a></td>
                    <td>{{ $stock->detail->product->make->name}}</td>
                    <td>{{ $stock->detail->product->group->name}}</td>
                    <td>{{ $stock->detail->product->serie->name}}</td>
                    <td>{{ $stock->detail->product->unit->name}}</td>
                    <td>{{ $stock->detail->product->presentation->name}}</td>
                    <td class="text-right">{{ $stock->stock}}</td>
                    <td class="text-right">{{ $stock->price}}</td>
                    <td class="text-right">{{ $stock->detail->purchase_price}}</td>
                    <td>{{ ($stock->detail->due_date ? $stock->detail->due_date:'N/A')}}</td>
                    <td><a href="{{  $stock->detail->order->url }}">#{{ $stock->detail->order->id }} ver detalles</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>