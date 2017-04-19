 <div class="panel panel-default">
    <div class="panel-heading">
        <a href="#"  class="btn btn-danger btn-xs pull-right" id="DestroyBill" style="margin-top: 10px">Cancelar</a>
    </div>
    <div class="panel-body">
        <address class="text-center">
            <h2>{{ $commerce->name }}</h2>
            {{ $commerce->address }}<br>
            Nit {{ $commerce->nit }}<br>
            Tel. {{ $commerce->phone }}<br>
            Res.No.2010-1-42-30823 del 29/11/2010<br>
            Factura Serie BB De 1 A 500000<br>
        </address>
        <hr>
        <address class="text-center">
            Factura <br>
            Serie <strong> A</strong>
            No. <strong id="bill_number"> 9</strong><br>
            <strong> {{ $order->created_at }}</strong>
        </address>
        <address>
            <strong>Nombre:</strong> {{  $order->people->name }}<br>
            <strong>Dirección:</strong> {{ $order->people->address }}<br>
            <strong>Nit:</strong> {{ $order->people->nit }}<br>
        </address>
        <table class="table table-condensed">
            <tr>
                <td colspan="2" class="text-left">Descripción</td>
                <td class="text-right">P/U</td>
                <td class="text-right">Total</td>
            </tr>
            @foreach ($order->details as $detail)
                <tr>
                    <td class="col-xs-2">
                        <a href="#" data-id="{{ $detail->id }}"  data-name="{{ $detail->product->name }}" class=" OrderDetailDelete"><i class="text-danger fa fa-minus-circle"></i></a>
                        {{ $detail->lot }}
                    </td>
                    <td>{{ $detail->product->name }}</td>
                    <td class="text-right">{{ $detail->sale_price }}</td>
                    <td class="text-right">{{ $detail->total_purchase }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right">Total</td>
                <td class="text-right"><strong>{{ $order->total }}</strong></td>
            </tr>
        </table>

    </div>
    <div class="panel-footer">
        <a href="" class="btn btn-success btn-block" style="margin-top: 10px">Facturar</a>
    </div>
</div>