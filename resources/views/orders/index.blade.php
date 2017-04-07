@extends('layouts.base')

@section('breadcrumb')
  <li class="breadcrumb-item">Pedidos</li>
@stop

@section('content')
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="icon-badge"></i>
          <strong>Pedidos</strong>
          <small>Listado</small>
          <a href="{{ route('orders.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span></a>
        </div>
        <div class="panel-body">
          {{ Form::open(['orders.index', 'method' => 'get']) }}
            <div class="form-group">
            <div class="">
              <div class="input-group">
                <input type="text" id="id" name="id" class="form-control" placeholder="Buscar">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Buscar</button>
                </span>
              </div>
              </div>
            </div>
          {{ Form::close() }}
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Proveedor</th>
                  <th>Priodidad</th>
                  <th>Fecha</th>
                  <th>Fec. ingreso</th>
                  <th>Estado</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                  <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->provider->name }}</td>
                    <td><span {!! Html::classes(['label', 'label-danger' => $order->priority == 'Alta', 'label-warning' => $order->priority == 'Media', 'label-success' => $order->priority == 'Baja']) !!}>{{ $order->priority }}</span></td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->delivery }}</td>
                    <td><span {!! Html::classes(['label', 'label-info' => $order->status == 'Creado', 'label-primary' => $order->status == 'Solicitado', 'label-warning' => $order->status == 'Confirmado', 'label-success' => $order->status == 'Entregado', 'label-default' => $order->status == 'Cancelado']) !!}>{{ $order->status }}</span></td>
                    <td>Q. {{ $order->total }}</td>
                    <td><a href="{{ $order->url }}" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> Detalle</a></td>

                      <td><a href="{{ $order->editUrl }}" class="btn btn-success btn-sm"> <i class="fa fa-pencil"></i> Editar</a></td>

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="panel-footer">
          {{ $orders->links() }}
        </div>
      </div>
    </div>
  </div>
@stop


