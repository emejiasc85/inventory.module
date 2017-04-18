<table class="table table-striped">
    <thead>
    <tr>
         <th>Producto</th>
         <th>Existencia</th>
         <th>P/U</th>
         <th></th>
     </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
             <tr>
                 <td>{{ $product->full_name }}</td>
                 <td>{{ $product->stock }}</td>
                 <td>{{ $product->sale_price }}</td>
                 <td>
                    <a href="#" title="agregar" data-id="{{ $product->id }}" data-name="{{ $product->full_name }}" data-price="{{ $product->sale_price }}"  class="btn btn-default  add-product"> <i class="text-success fa fa-shopping-cart"></i></a>
                </td>
             </tr>
         @endforeach
    </tbody>
 </table>