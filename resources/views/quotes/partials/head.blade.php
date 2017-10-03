 <div class="panel panel-default">
    <div class="panel-heading">

        @if ($order->status != 'Ingresado' || auth()->user()->isAdmin())
            <a href="#" title="Cancelar"  class="btn btn-link btn-sm pull-right hidden-print" id="DestroyOrder" style="margin-top: 2px"><span class="fa fa-2x fa-trash-o text-danger"></span></a>
        @endif
        @if ($order->status == 'Ingresado')
            <a href="#" title="Revertir Cotización"  class="btn btn-link btn-sm pull-right hidden-print" id="RevertOrder" style="margin-top: 2px"><span class="fa fa-2x fa-undo text-success"></span></a>
        @endif
    </div>
    <div class="panel-body">
        <address class="text-center">
            <h2>{{ $commerce->name }}</h2>
            {{ $commerce->address }}<br>
            Nit {{ $commerce->nit }}<br>
            Tel. {{ $commerce->phone }}<br>
        </address>
        <hr>
            <address class="text-center">
                Cotización <br>
                No. <strong> {{ $order->quotation->id }}</strong><br>
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
                <a href="#" id="Order" class="btn btn-success btn-lg btn-block" style="margin-top: 10px">Finalizar Cotización</a>
            @endif
        @endif

        @if ($order->status == 'Ingresado')
            <a href="#" class="btn btn-primary hidden-print btn-lg btn-block " title="Imprimir" onclick="window.print()"><span class="fa  fa-print"></span> Imprimir</a>
        @endif
        </div>
    </div>
</div>