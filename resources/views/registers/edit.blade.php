@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{ route('makes.index') }}">Caja</a></li>
	 <li class="breadcrumb-item active">Cerrar</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-6 col-xxs-12">
                    <a href="{{ route('cash.registers.bills', $register)}}">
                        <div class="smallstat">
                            <span class="value text-success">Q. {{ $register->sales->sum('total')}}</span>
                            <span class="title">Ventas</span>
                        </div><!--/.smallstat-->
                    </a>
                </div><!--/.col-->                        
                <div class="col-lg-4 col-sm-6 col-xs-6 col-xxs-12">
                    <a href="{{ route('cash.registers.payments', $register)}}">
                        <div class="smallstat">
                            <span class="value text-primary">Q. {{ $register->payments->sum('amount')}}</span>
                            <span class="title">Abonos a Creditos</span>
                        </div><!--/.smallstat-->
                    </a>
                </div><!--/.col-->                        
                <div class="col-lg-4 col-sm-6 col-xs-6 col-xxs-12">
                    <a href="{{ route('cash.registers.credits', $register)}}">
                    <div class="smallstat">
                        <span class="value text-muted">Q. {{ $register->credits->sum('total')}}</span>
                        <span class="title">Creditos</span>
                    </div><!--/.smallstat-->
                    </a>
                </div><!--/.col-->                        
                <div class="col-lg-4 col-sm-6 col-xs-6 col-xxs-12">
                    <div class="smallstat">
                        <span class="value text-muted">Q. {{ $register->initial_cash}}</span>
                        <p class="title">Saldo Inicial  @if(!$register->status)<a href="#" data-toggle="modal" data-target="#editInitialCash">Editar</a>@endif</p>
                        
                    </div><!--/.smallstat-->
                </div><!--/.col-->     
                @if(!$register->status)
                    <div class="col-lg-4 col-sm-6 col-xs-6 col-xxs-12">
                        <a  href="#" data-toggle="modal" data-target="#closeRegister">
                            <div class="smallstat">
                                <i class="fa fa-ban primary"></i>
                                <span class="value text-primary">Cerrar Caja</span>
                            </div><!--/.smallstat-->
                        </a>
                    </div><!--/.col-->                        

                @endif                   
                <div class="col-lg-4 col-sm-6 col-xs-6 col-xxs-12">
                    <a  href="#" data-toggle="modal" data-target="#addDeposit">
                        <div class="smallstat">
                            <i class="fa fa-inbox info"></i>
                            <span class="value text-primary">Agregar Deposito</span>
                        </div><!--/.smallstat-->
                    </a>
                </div><!--/.col-->                        
            </div>
            <div class="panel panel-default" style="border-top: 2px solid #4dbd74">
                <div class="panel-heading">
                    <strong>Depositos</strong>
                </div>
                <div class="panel-body">
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


