 <table class="table table-striped">
    <thead>
    <tr>
         <th>ID</th>
         <th>Nombre</th>
         <th>Grupo</th>
         <th>Serie</th>
         <th>Categoria</th>
         <th>Marca</th>
         <th>Presentación</th>
         <th>Medida</th>
         <th>Minimo</th>
         <th>P/U</th>
         <th>P/O</th>
         <th colspan="2">Acciones</th>
     </tr>

    </thead>
    <tbody>
        @foreach ($products as $product)
             <tr>
                 <td>{{ $product->id }}</td>
                 <td><a href="{{ $product->url }}">{{ $product->name }}</a></td>
                 <td>{{ $product->group->name }}</td>
                 <td>{{ $product->serie->name }}</td>
                 <td>{{ $product->category->name }}</td>
                 <td>{{ $product->make->name }}</td>
                 <td>{{ $product->presentation->name }}</td>
                 <td>{{ $product->unit->name }}</td>
                 <td>{{ $product->minimum_stock }}</td>
                 <td>{{ $product->price }}</td>
                 <td>{{ $product->offer_price }}</td>
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