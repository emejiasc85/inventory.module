 <div class="panel panel-default">
    <div class="panel-heading">
        Credito:
        @if($order->people->restCredit == 0)
        <span class="text-danger">Q. {{ $order->people->restCredit}}</span>
        @else
        <span class="text-success">Q. {{ $order->people->restCredit}}</span>
        @endif
        @if ($order->status != 'Ingresado' || auth()->user()->isAdmin())
            <a href="#" title="Cancelar"  class="btn btn-danger btn-sm pull-right hidden-print" id="DestroyBill" style="margin-top: 2px"><span class="fa fa-2x fa-trash-o"></span></a>
        @endif
        @if ($order->status == 'Ingresado')
            <a href="#" title="Revertir"  class="btn btn-link btn-sm pull-right hidden-print" id="RevertBill" style="margin-top: 2px"><span class="fa fa-2x fa-undo text-success"></span></a>
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
                @if ($order->bill)
                    Factura <br>
                    Serie <strong> {{ $order->bill->resolution->serie }}</strong>
                    No. <strong id="bill_number"> {{ $order->bill->bill }}</strong><br>
                    <strong> {{ $order->created_at }}</strong>
                @else
                    Recibo
                    No. <strong id="bill_number"> {{ $order->id }}</strong><br>
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
                    <td>{{ $detail->product->name }} ({{ $detail->product->make->name }})</td>
                    <td class="text-right">{{ $detail->sale_price }}</td>
                    <td class="text-right">{{ $detail->total_purchase }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right">Total</td>
                <td class="text-right"><strong>{{ $order->total }}</strong></td>
            </tr>
        </table>
        <span><small>Usuario: {{ $order->user->name }}</small> </span>
    </div>
    <div class="panel-footer">
        @if ($order->details->count() > 0)
            @if ($order->status != 'Ingresado')
                <a href="#" id="Bill" class="btn btn-success btn-lg btn-block" style="margin-top: 10px">Finalizar Venta</a>
            @endif
            @if ($order->status == 'Ingresado')
                <a href="#" class="btn btn-primary hidden-print btn-lg btn-block " title="Imprimir" onclick="window.print()"><span class="fa  fa-print"></span> Imprimir</a>
            @endif
        @endif
    </div>
</div>