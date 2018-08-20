@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{ route('bills.index') }}">Caja</a></li>
	 <li class="breadcrumb-item active">Cerrar</li>
@stop

@section('content')
    <div class="col-xs-12">
        <div class="row">
                <div class="invoice">
                        <div class="row header visible-print-block">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        @if ($commerce->logo_path)
                                            <img src="{{  route('commerces.logo', $commerce) }} " alt="" class="img-rounded pull-right" width="75">
                                        @endif
                                        <p><strong>{{$commerce->name}}</strong></p>
                                        <p>{{$commerce->patent_name}}</p>
                                        <p>{{$commerce->address}}</p>
                                    </div>
                                </div>
                            </div><!--/col-->
                        </div>
                        <div class="row header">
                            <div class="col-xs-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        ID
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>#{{$register->id}}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Fecha de Apertura
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>{{$register->created_at}}</strong></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Fecha de Cierre
                                    </div>
                                    <div class="panel-body">
                                        @if(!$register->status)
                                            <a  href="#" data-toggle="modal" data-target="#closeRegister">
                                                <i class="fa fa-ban primary"></i>
                                                <span class="value text-primary"><strong>Cerrar Caja</span>
                                            </a>
                                        @else
                                            <p><strong>{{$register->closing_date}}</strong></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Usuario apertura
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>{{$register->user->name}}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Movimiento</th>
                                            <th class="hidden-print">Opcion</th>
                                            <th class="center">Ventas</th>
                                            <th class="right">Productos</th>
                                            <th class="right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">1</td>
                                            <td class="left">Pagos en Efectivo</td>
                                            <td class="left hidden-print"><a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 1])}}">Detalles </a></td>
                                            <td class="center">{{ $register->payments->where('payment_method_id', 1)->count() }}</td>
                                            <td class="right">{{  array_sum(data_get($register->payments->where('payment_method_id', 1)->load('order.details'), '*.order.details.*.lot'))  }}</td>
                                            <td class="right">{{ number_format($register->payments->where('payment_method_id', 1)->sum('amount'),2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="center">2</td>
                                            <td class="left">Pagos con tarjeta</td>
                                            <td class="left hidden-print"><a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 2])}}">Detalles </a></td>
                                            <td class="center">{{ $register->payments->where('payment_method_id', 2)->count() }}</td>
                                            <td class="right">{{  array_sum(data_get($register->payments->where('payment_method_id', 2)->load('order.details'), '*.order.details.*.lot'))  }}</td>
                                            <td class="right">{{ number_format($register->payments->where('payment_method_id', 2)->sum('amount'),2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="center">3</td>
                                            <td class="left">Pagos con cheques</td>
                                            <td class="left hidden-print"><a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 3])}}">Detalles </a></td>
                                            <td class="center">{{ $register->payments->where('payment_method_id', 3)->count() }}</td>
                                            <td class="right">{{  array_sum(data_get($register->payments->where('payment_method_id', 3)->load('order.details'), '*.order.details.*.lot'))  }}</td>
                                            <td class="right">{{ number_format($register->payments->where('payment_method_id', 3)->sum('amount'),2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="center">4</td>
                                            <td class="left">Creditos</td>
                                            <td class="left hidden-print"><a href="{{ route('cash.registers.bills', [$register, 'payment_method_id' => 4])}}">Detalles </a></td>
                                            <td class="center">{{ $register->payments->where('payment_method_id', 4)->count() }}</td>
                                            <td class="right">{{  array_sum(data_get($register->payments->where('payment_method_id', 4)->load('order.details'), '*.order.details.*.lot'))  }}</td>
                                            <td class="right">{{ number_format($register->payments->where('payment_method_id', 4)->sum('amount'),2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="center">5</td>
                                            <td class="left">Abonos a creditos</td>
                                            <td class="left hidden-print"><a href="{{ route('cash.registers.payments', $register)}}">Detalles </a></td>
                                            <td class="center">N/A</td>
                                            <td class="right">N/A</td>
                                            <td class="right">{{ number_format($register->payments->where('payment_method_id', 6)->sum('amount'),2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="row">

                                    <div class="col-lg-4 col-sm-5 notice">
                                        {{-- <div class="well">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                        </div> --}}
                                    </div><!--/col-->

                                    <div class="col-lg-4 col-lg-offset-4 col-sm-5 col-sm-offset-2 recap">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left"><strong>Subtotal</strong></td>
                                                    <td class="right">Q.{{number_format($register->payments->whereIn('payment_method_id', [1,2,3,4,5,6])->sum('amount'),2)}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Saldo Inicial @if(!$register->status)<a href="#" data-toggle="modal" data-target="#editInitialCash" class="hidden-print"><i class="fa fa-pencil"></i></a>@endif </strong></td>
                                                    <td class="right">Q.{{ $register->initial_cash }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Creditos <i class="text-danger">(-)</i></strong></td>
                                                    <td class="right text-danger">Q.{{ number_format($register->payments->where('payment_method_id', 4)->sum('amount'),2)}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Total</strong></td>
                                                    <td class="right"><strong>Q.{{ number_format($register->payments->whereIn('payment_method_id', [1,2,3,5,6])->sum('amount'),2)}}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="#" class="hidden-print btn btn-info" onclick="javascript:window.print();"><i class="  fa fa-print"></i> Imprimir</a>
                                        <a href="{{ route('cash.registers.bills', $register)}} " class="hidden-print btn btn-success"> Detalles</a>
                                    </div><!--/col-->

                                </div><!--/row-->
                            </div>
                        </div>

                    </div>
        </div>

        <div class="panel panel-default " style="border-top: 2px solid #4dbd74">
            <div class="panel-heading">
                    <strong>Depositos de caja</strong>
                    <a  href="#" data-toggle="modal" style="margin-top: 5px" data-target="#addDeposit" class="hidden-print pull-right btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>
                        <span>Agregar Deposito</span>
                    </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Fecha</th>
                            <th>Banco</th>
                            <th>Cuenta</th>
                            <th>No. Documento</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($register->deposits as $deposit)
                            <tr>
                                <td>{{ $deposit->date}}</td>
                                <td>{{ $deposit->bank}}</td>
                                <td>{{ $deposit->account}}</td>
                                <td>{{ $deposit->baucher}}</td>
                                <td>{{ $deposit->amount}}</td>
                                <td><a href="#" data-id="{{$deposit->id}}" class="btn btn-link btn-destroy-deposit"><i class="fa fa-trash text-danger"></i></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
@stop
@section('modals')
<!-- Modal -->
<div class="modal fade" id="closeRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cerrar Caja</h4>
      </div>
        {!! Form::model($register, ['route' => ['cash.registers.close', $register ], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
      <div class="modal-body">
            <h2>¿Estas seguro de cerrar esta caja?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Cerrar Caja</button>
      </div>
	    {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editInitialCash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Saldo Inicial</h4>
      </div>
        {!! Form::model($register, ['route' => ['cash.registers.update', $register ], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
      <div class="modal-body">
            {!! Field::text('initial_cash')!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Editar Saldo Inicial</button>
      </div>
	    {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="modal fade" id="addDeposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-default" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Depositos a caja</h4>
      </div>
        {!! Form::open(['route' => ['cash.registers.deposits.create', $register ], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
      <div class="modal-body">
            {!! Field::date('date')!!}
            {!! Field::text('bank')!!}
            {!! Field::text('account')!!}
            {!! Field::text('baucher')!!}
            {!! Field::text('amount')!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Agregar Deposito</button>
      </div>
	    {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="modal fade" id="DeleteDeposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-sm modal-danger" role="document">
    <div class="modal-content modal-danger">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Eliminar Depositos a caja</h4>
      </div>
        {!! Form::open(['route' => ['cash.registers.deposits.destroy'], 'method' => 'delete', 'class' => 'form-horizontal']) !!}
      <div class="modal-body">
            <h2>¿Estas seguro de eliminar este deposito?</h2>
            {!! Field::hidden('deposit_id', null, ['id' =>'deposit_id'])!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Eliminar Deposito</button>
      </div>
	    {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

            $('.btn-destroy-deposit').click( function (e) {
                e.preventDefault();
                var link        = $(this)
                var value       = link.data('id');
                var input_value = $('#deposit_id');
                input_value.val(value);
                $('#DeleteDeposit').modal('toggle');
            });
        });

    </script>
@endsection
