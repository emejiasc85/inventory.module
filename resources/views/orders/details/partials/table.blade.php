<table class="table table-striped">
    <thead>
    <tr>
         <th>ID</th>
         <th>Producto</th>
         <th>Marca</th>
         <th>Descripción</th>
         <th>Grupo</th>
         <th>Serie</th>
         <th>Presentación</th>
         <th>Unid. Medida</th>
         <th>Acciones</th>
     </tr>

    </thead>
    <tbody>

        @foreach ($products as $product)
             <tr>
                 <td>{{ $product->id }}</td>
                 <td><a href="{{ $product->url }}">{{ $product->name }}</a></td>
                 <td>{{ $product->make->name }}</td>
                 <td>{{ $product->description }}</td>
                 <td>{{ $product->group->name }}</td>
                 <td>{{ $product->serie->name }}</td>
                 <td>{{ $product->presentation->name }}</td>
                 <td>{{ $product->unit->name }}</td>
                 <td>
                    <a href="#" title="agregar" data-id="{{ $product->id }}" data-name="{{ $product->name }}"  class="btn btn-default  add-product"> <i class="text-success fa fa-shopping-cart"></i></a>
                </td>
             </tr>
         @endforeach
    </tbody>
 </table>