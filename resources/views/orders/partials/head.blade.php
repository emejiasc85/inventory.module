    <table class="table">
        <tr>
            <th class="text-left">Prioridad:</th>
            <td class="text-right">
                <span {!! Html::classes(['label', 'label-danger' => $order->priority == 'Alta', 'label-warning' => $order->priority == 'Media', 'label-success' => $order->priority == 'Baja']) !!}>{{ $order->priority }}
                </span>
            </td>
        </tr>
        <tr>
            <th class="text-left">Proveedor:</th>
            <td class="text-right">{{ $order->people->name }}</td>
        </tr>
        <tr>
            <th class="text-left">Creado: </th>
            <td class="text-right">{{ $order->created_at->format('d-m-y') }}</td>
        </tr>
        <tr>
            <th class="text-left">Ingresó: </th>
            <td class="text-right">
                @if ($order->status == 'Ingresado')
                    {{ $order->updated_at->format('d-m-y') }}
                @else
                    N/A
                @endif
            </td>
        </tr>
    </table>