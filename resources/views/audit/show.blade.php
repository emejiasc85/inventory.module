@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item"><a href="{{ route('audit.index') }}">Auditorias</a></li>
	 <li class="breadcrumb-item active">Auditoria #{{ $audit->id }}</li>
@stop

@section('content')
	<div class="row">
        @include('partials.errors')
		<div class="col-xs-12 col-sm-3">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <strong>Auditoria</strong>
                    <i class="badge pull-right">{{ $audit->id }}</i>
                </div>
				<div class="panel-body">
                @include('audit.partials.head')
                    @if ($audit->status == 'Cancelado')
                    <h2 class="text-muted">Auditoria Cancelada</h2>
                    @else
                        @if ($audit->details->count()>0)
                        <a href="#" id="auditStatus" data-status="{{ $audit->status }}" {!! Html::classes([
                            'btn btn-block',
                            'btn-primary' => $audit->status == 'Creado',
                            'btn-default' => $audit->status == 'Finalizado',
                            'btn-default' => $audit->status == 'Finalizado',
                        ]) !!}>
                            @if ($audit->status == 'Creado')
                                Finalizar Auditoria
                            @elseif ($audit->status == 'Finalizado')
                                Reabrir Auditoria
                            @elseif ($audit->status == 'Finalizado')
                                Revertir Auditoria
                            @endif
                        </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9">
            @include('audit.partials.details')
        </div>
	</div>
@stop
@section('modals')
    @include('audit.details.partials.modal-destroy')
    @include('audit.partials.changeStatus')
@stop
@section('scripts')
    <script>
        $('.OrderDetailDelete').click( function (e) {
            e.preventDefault();
            var link    = $(this)
            var value   = link.data('id');
            var name   = link.data('name');
            var input_value = $('#value_id');
            var ProductName = $('#ProductName');
            input_value.val(value);
            ProductName.text(name);
            $('#confirmDelete').modal('toggle');
        });


        $('#auditStatus').click(function (e) {
            e.preventDefault();
            var link    = $(this)
            var status   = link.data('status');
            var input_value = $('#value_status');
            if(status == 'Creado'){
                input_value.val('Finalizado');
            }
            else if(status=='Finalizado'){
                input_value.val('Creado');
            }
            else if(status=='Finalizado'){
                input_value.val('Revertir');
            }
            $('#changeStatus').modal('toggle');
        });
    </script>

@stop


