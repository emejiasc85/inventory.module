@extends('layouts.base')

@section('breadcrumb')
  <li class="breadcrumb-item">Auditorias</li>
@stop

@section('content')
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="fa fa-truck"></i>
          <strong>Auditorias</strong>
          <small>Listado</small>
          <a href="{{ route('audit.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Agregar Auditoria</a>
        </div>
        <div class="panel-body">
          {{ Form::model(Request::all(),['audit.index', 'method' => 'get']) }}
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
                  <th>Auditor</th>
                  <th>Empresa</th>
                  <th>Fec. inicio</th>
                  <th>Fec. finalizo</th>
                  <th>Estado</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($audits as $audit)
                  <tr>
                    <td>{{ $audit->id }}</td>
                    <td>{{ $audit->user->name }}</td>
                    <td>{{ $audit->commerces->name }}</td>

                    {{-- <td><span {!! Html::classes(['label', 'label-danger' => $audit->priority == 'Alta', 'label-warning' => $audit->priority == 'Media', 'label-success' => $audit->priority == 'Baja']) !!}>{{ $audit->priority }}</span></td> --}}
                    <td>{{ $audit->created_at }}</td>
                    <td>
                      @if ($audit->status == 'Ingresado')
                          {{ $audit->updated_at->format('d-m-y') }}
                      @else
                          N/A
                      @endif
                    </td>
                    <td><span {!! Html::classes(['label', 'label-info' => $audit->status == 'Creado','label-success' => $audit->status == 'Finalizado', 'label-default' => $audit->status == 'Cancelado']) !!}>{{ $audit->status }}</span></td>
                    <td><a href="{{ $audit->url }}" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> Detalle</a></td>
                    <td>
                    @if ($audit->status == 'Creado' || $audit->status == 'Solicitado')
                      <a href="{{ $audit->editUrl }}" class="btn btn-success btn-sm"> <i class="fa fa-pencil"></i> Editar</a>
                    @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="panel-footer">
          {{ $audits->links() }}
        </div>
      </div>
    </div>
  </div>
@stop


