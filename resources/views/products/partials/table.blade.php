 <table class="table table-responsive table-striped">
    <thead>

    <tr>
         <th>Producto</th>
         <th>Descripción</th>
         <th>Grupo</th>
         <th>Presentación</th>
         <th>Unid. Medida</th>
         <th>Minimo</th>
         <th>Acciones</th>
     </tr>

    </thead>
    <tbody>

        @foreach ($products as $product)
             <tr>
                 <td>{{ $product->name }}</td>
                 <td>{{ $product->description }}</td>
                 <td>{{ $product->group->name }}</td>
                 <td>{{ $product->presentation->name }}</td>
                 <td>{{ $product->unit->name }}</td>
                 <td>{{ $product->minimum_stock }}</td>
                 <td>
                    <a href="{{ $product->url }}" class="btn btn-info "> <i class="fa fa-eye"></i>Detalle</a>
                    <a href="{{ $product->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i>Editar</a>
                </td>
             </tr>
         @endforeach
    </tbody>
 </table>