<div class="panel panel-default" style="border-top: 2px solid #20a8d8">
    <div class="panel-heading">
        @if ($audit->status == 'Creado' || $audit->status == 'Solicitado')
            <a href="{{ route('auditDetail.create', $audit) }}" class="btn btn-primary">
            <span class="fa fa-plus" ></span> Agregar Producto</a>
        @endif
        <span {!! Html::classes(['pull-right label', 'label-info' => $audit->status == 'Creado', 'label-primary' => $audit->status == 'Solicitado', 'label-success' => $audit->status == 'Ingresado', 'label-default' => $audit->status == 'Cancelado']) !!}>{{ $audit->status }}
        </span>
    </div>
    <div class="panel-body">
        {!! Form::open([ 'route' => ['auditDetail.update', $audit], 'method' => 'PUT']) !!}
        <table class="table table-striped">
            <thead>
                <tr>
                     <th>
                     </th>
                     <th>Producto</th>
                     <th>Cant Almacenada</th>
                     <th>Cant Auditada</th>
                     <th>Vencimiento</th>
                     <th class="text-right">Estado</th>
                 </tr>
            </thead>
            <tbody>
            @foreach ($audit->details as $detail)
                <tr>
                    {!! Field::hidden('id[]', $detail->id)  !!}
                    <td>
                        @if ($audit->status == 'Creado' || $audit->status == 'Solicitado')
                        <a href="#" data-id="{{ $detail->id }}"  data-name="{{ $detail->product->name }}" class="btn btn-danger btn-xs OrderDetailDelete"><i class="fa fa-minus-circle"></i></a>
                        @endif
                    </td>
                    <td><a href="{{ $detail->product->url }}">{{ $detail->product->name}}</a></td>
                     @if ($audit->status == 'Finalizado' || $audit->status == 'Cancelado')
                        <td>{{ $detail->current_stock }}</td>
                        <td>{{ $detail->audited_stock }}</td>
                        <td>{{$detail->stock->detail->due_date }}</td>
                        <td>{{ $detail->due_date }}</td>
                        @else
                        <td class="col-xs-1"><input type="text" disabled="" name="current_stock[]" class="form-control input-sm" value="{{ $detail->current_stock }} "></td>
                        <td class="col-xs-1"><input type="text" name="audited_stock[]" class="form-control input-sm" value="{{ $detail->audited_stock }}"></td>
                        <td class="col-xs-1"><input type="date" disabled name="due_date[]" class="form-control input-sm" value="{{$detail->stock->detail->due_date }}"></td>
                    @endif
                    <td class="text-right "><strong>
                        @if($detail->status=="ok")
                            <i class="text-success fa fa-check-circle fa-2x" aria-hidden="true"></i>
                        @else($detail->status=="ok")
                            <i class="text-danger fa fa-times-circle fa-2x" aria-hidden="true"></i>
                        @endif
                    </strong></td>
                </tr>
            @endforeach
            </tbody>
     </table>
     <div class="row">
         <div class="col-lg-4 col-lg-offset-8 col-sm-5 col-sm-offset-4 recap">
         {{--
            <table class="table table-clear">
                <tbody>
                    <tr>
                        <td class="left"><strong>Costo Total</strong></td>
                        <td class="right"><strong>Q. {{ $audit->total }}</strong></td>
                    </tr>
                </tbody>
            </table>
        --}}
            @if ($audit->status == 'Creado' || $audit->status == 'Solicitado')
                @if ($audit->details->count()>0)
                    <button type="submit" class="btn btn-default btn-block"><i class="fa fa-save"></i> Guardar</button>
                @endif
            @endif
        </div>

     </div>
    {!! Form::close() !!}
    </div>
</div>