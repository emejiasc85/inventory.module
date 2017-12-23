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
                <td><a target="_blank" href="{{ route('products.show', [$product->id, $product->slug])}}">{{ $product->full_name }}</a></td>
                <td>{{ $product->stock }}</td>
                 <td>{{ $product->price }}</td>
                 <td>
                    <a href="#" title="agregar" data-id="{{ $product->id }}" data-name="{{ $product->full_name }}" data-price="{{ $product->price }}"  class="btn btn-default  add-product"> <i class="text-success fa fa-shopping-cart"></i></a>
                </td>
             </tr>
         @endforeach
    </tbody>
 </table>