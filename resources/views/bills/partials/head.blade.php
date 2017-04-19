 <div class="panel panel-default">
    <div class="panel-heading">
        @if ($order->status != 'Ingresado')
            <a href="#"  class="btn btn-danger btn-xs pull-right" id="DestroyBill" style="margin-top: 10px">Cancelar</a>
        @endif
    </div>
    <div class="panel-body">
        <address class="text-center">
            <h2>{{ $commerce->name }}</h2>
            {{ $commerce->address }}<br>
            Nit {{ $commerce->nit }}<br>
            Tel. {{ $commerce->phone }}<br>
            @if ($order->bill)
                Res. No. {{ $order->bill->resolution->resolution }} del {{ $order->bill->resolution->date->format('d-m-Y') }}<br>
                Factura Serie {{ $order->bill->resolution->serie }} De {{ $order->bill->resolution->from }} al {{ $order->bill->resolution->to }}<br>
            @endif
        </address>
        <hr>
            <address class="text-center">
                Factura <br>
                @if ($order->bill)
                    Serie <strong> {{ $order->bill->resolution->serie }}</strong>
                    No. <strong id="bill_number"> {{ $order->bill->bill }}</strong><br>
                    <strong> {{ $order->created_at }}</strong>
                @endif
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
                        @if ($order->status != 'Ingresado')
                            <a href="#" data-id="{{ $detail->id }}"  data-name="{{ $detail->product->name }}" class=" OrderDetailDelete"><i class="text-danger fa fa-minus-circle"></i></a>
                        @endif
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
        @if ($order->details->count() > 0)
            @if ($order->status != 'Ingresado')
                <a href="#" id="Bill" class="btn btn-success btn-lg btn-block" style="margin-top: 10px">Facturar</a>
            @endif
        @endif
    </div>
</div>