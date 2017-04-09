    <table class="table">
        <tr>
            <th class="text-left">Prioridad:</th>
            <td class="text-right">
            {{$audit->status}}
                <span {!! Html::classes(['label', 'label-danger' => $audit->priority == 'Alta', 'label-warning' => $audit->priority == 'Media', 'label-success' => $audit->priority == 'Baja']) !!}>{{ $audit->priority }}
                </span>
            </td>
        </tr>
        <tr>
            <th class="text-left">Proveedor:</th>
            <td class="text-right">{{ $audit->user->name }}</td>
        </tr>
        <tr>
            <th class="text-left">Creado: </th>
            <td class="text-right">{{ $audit->created_at->format('d-m-y') }}</td>
        </tr>
        <tr>
            <th class="text-left">Ingresó: </th>
            <td class="text-right">
                @if ($audit->status == 'Ingresado')
                    {{ $audit->updated_at->format('d-m-y') }}
                @else
                    N/A
                @endif
            </td>
        </tr>
    </table>