 <table class="table table-striped">
    <thead>
    <tr>
         <th>ID</th>
         <th>barcode</th>
         <th>Producto</th>
         <th>Marca</th>
         <th>Descripción</th>
         <th>Grupo</th>
         <th>Presentación</th>
         <th>Unid. Medida</th>
         <th>Minimo</th>
         <th>Precio Venta</th>
         <th colspan="2">Acciones</th>
     </tr>

    </thead>
    <tbody>
        @foreach ($products as $product)
             <tr>
                 <td>{{ $product->id }}</td>
                 <td>{{ $product->barcode }}</td>
                 <td><a href="{{ $product->url }}">{{ $product->name }}</a></td>
                 <td>{{ $product->make->name }}</td>
                 <td>{{ $product->description }}</td>
                 <td>{{ $product->group->name }}</td>
                 <td>{{ $product->presentation->name }}</td>
                 <td>{{ $product->unit->name }}</td>
                 <td>{{ $product->minimum_stock }}</td>
                 <td>{{ $product->price }}</td>
                 <td>
                    <a href="{{ $product->url }}" class="btn btn-link "> <i class="fa fa-eye text-info"></i> Detalle</a>
                </td>
                <td>
                    <a href="{{ $product->editUrl }}" class="btn btn-link "> <i class="fa fa-pencil text-success"></i> Editar</a>
                </td>
             </tr>
         @endforeach
    </tbody>
 </table>