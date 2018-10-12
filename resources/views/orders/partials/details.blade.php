<div class="panel panel-default" style="border-top: 2px solid #20a8d8">
    <div class="panel-heading">
        @if ($order->status == 'Creado' || $order->status == 'Solicitado')
            <a href="{{ route('orders.details.create', $order) }}" class="btn btn-primary">
            <span class="fa fa-plus" ></span> Agregar Producto</a>
        @endif
        <span {!! Html::classes(['pull-right label', 'label-info' => $order->status == 'Creado', 'label-primary' => $order->status == 'Solicitado', 'label-success' => $order->status == 'Ingresado', 'label-default' => $order->status == 'Cancelado']) !!}>{{ $order->status }}
        </span>
    </div>
    <div class="panel-body">
        {!! Form::open([ 'route' => ['orders.details.update', $order], 'method' => 'PUT']) !!}
        <table class="table table-striped">
            <thead>
                <tr>
                     <th>
                     </th>
                     <th>ID</th>
                     <th>Producto</th>
                     <th>Cant</th>
                     <th>Precio Compra</th>
                     <th>Precio Venta</th>
                     <th>Precio Actual</th>
                     <th>Vencimiento</th>
                     <th class="text-right">Total Compra</th>
                     <th class="text-right">Total Venta</th>
                 </tr>
            </thead>
            <tbody>
            @foreach ($order->details as $detail)
                <tr>
                    {!! Field::hidden('id[]', $detail->id)  !!}
                    <td>
                        @if ($order->status == 'Creado' || $order->status == 'Solicitado')
                        <a href="#" data-id="{{ $detail->id }}"  data-name="{{ $detail->product->name }}" class="btn btn-danger btn-xs OrderDetailDelete"><i class="fa fa-minus-circle"></i></a>
                        @endif
                    </td>
                    <td>{{$detail->product->id}}</td>
                    <td><a href="{{ $detail->product->url }}">{{ $detail->product->name}} (medida: {{$detail->product->unit->name }}/serie: {{ $detail->product->serie->name }})</a></td>
                     @if ($order->status == 'Ingresado' || $order->status == 'Cancelado')
                        <td>{{ $detail->lot }}</td>
                        <td>Q. {{ $detail->purchase_price }}</td>
                        <td>Q. {{ $detail->sale_price }}</td>
                        <td>Q. {{ $detail->product->price }}</td>
                        <td>{{ $detail->due_date }}</td>
                        <td class="text-right">Q. {{ $detail->total_purchase}}</td>
                        <td class="text-right">Q. {{ $detail->lot * $detail->sale_price}}</td>
                    @else
                        <td class="col-xs-1"><input type="text" name="lot[]" min="0" step="1" required class="form-control input-sm" value="{{ $detail->lot }} "></td>
                        <td class="col-xs-1"><input type="text" name="purchase_price[]" min="0" required  step="1" class="form-control input-sm" value="{{ $detail->purchase_price }}"></td>
                        <td class="col-xs-1"><input type="text" name="sale_price[]" min="0" step="1" required  class="form-control input-sm" value="{{ $detail->sale_price }}"></td>
                        <td class="col-xs-1"><input type="text" name="price[]" min="0" step="1" disabled class="form-control input-sm" value="{{ $detail->product->price }}"></td>
                        <td class="col-xs-1"><input type="date" name="due_date[]" class="form-control input-sm" value="{{ $detail->due_date }}"></td>
                        <td class="text-right"><strong>Q. {{ $detail->total_purchase }}</strong></td>
                        <td class="text-right"><strong>Q. {{ $detail->lot * $detail->sale_price}}</strong></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
     </table>
     <div class="row">
            <div class="col-lg-6 col-sm-5 notice">
                    <div class="well">
                        <ul>
                            <li>Si El Precio de Venta es Mayor al Precio Actual el sistema <strong>Actualizará</strong> al nuevo precio </li>
                            <li>Si El Precio de Venta es Menor al Precio Actual el sistema <strong>Mantendrá</strong> el precio </li>
                        </ul>
                    </div>
                </div>
         <div class="col-lg-4 col-lg-offset-2 col-sm-5 col-sm-offset-2 recap">
            <table class="table table-clear table-striped">
                <tbody>
                    <tr>
                        <td class="right">Total Compra</td>
                        <td class="right"><strong>Q. {{ $order->total }}</strong></td>
                    </tr>

                    @php
                        $sale = 0;
                    @endphp
                    @foreach ($order->details as $element)
                        @php
                            $var = $element->lot * $element->sale_price;
                            $sale = $sale + $var;
                        @endphp
                    @endforeach
                    <tr >
                        <td class="right">Total Venta</td>
                        <td class="right"><strong>Q. {{ $sale }}</strong></td>
                    </tr>
                    <tr style="border-top: 1.5px solid black !important">
                        <td class="right"><strong>Ganancia</strong></td>
                        <td class="right"><strong>Q. {{ $sale - $order->total }}</strong></td>
                    </tr>
                </tbody>
            </table>
            @if ($order->status == 'Creado' || $order->status == 'Solicitado')
                @if ($order->details->count()>0)
                    <button type="submit" class="btn btn-default btn-block"><i class="fa fa-save"></i> Guardar</button>
                @endif
            @endif
        </div>

     </div>
    {!! Form::close() !!}
    </div>
</div>