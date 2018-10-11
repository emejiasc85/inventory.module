<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
         <th>Producto</th>
         <th>Grupo</th>
         <th>Existencia</th>
         <th>P/U</th>
         <th>P/O</th>
         <th></th>
     </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
             <tr>
                <td>{{ $product->id}}</td>
                <td><a target="_blank" href="{{ route('products.show', [$product->id, $product->slug])}}">{{ $product->full_name }}</a></td>
                 <td>{{ $product->name }}</td> {{-- groups --}}
                 <td>{{ $product->stock }}</td>
                 <td>{{ $product->price }}</td>
                 <td>{{ $product->offer_price }}</td>
                 <td>
                    <a href="#" title="agregar" data-id="{{ $product->id }}" data-name="{{ $product->full_name }}" data-offer="{{ $product->offer_price }}" data-price="{{ $product->price }}" v  class="btn btn-default  add-product"> <i class="text-success fa fa-shopping-cart"></i></a>
                </td>
             </tr>
         @endforeach
    </tbody>
 </table>