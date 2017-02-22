 <table class="table col-sm-12">
     <tr>
         <th>Producto</th>
         <th>Descripción</th>
         <th>Grupo</th>
         <th>Presentación</th>
         <th>Unid. Medida</th>
         <th>Minimo</th>
         <th>Acciones</th>
     </tr>
     @foreach ($products as $product)
         <tr>
             <td>{{ $product->name }}</td>
             <td>{{ $product->description }}</td>
             <td>{{ $product->group->name }}</td>
             <td>{{ $product->presentation->name }}</td>
             <td>{{ $product->unit->name }}</td>
             <td>{{ $product->minimum_stock }}</td>
             <td><a href="{{ $product->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i>Editar</a></td>
         </tr>
     @endforeach
 </table>