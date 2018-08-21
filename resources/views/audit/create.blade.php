@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item"><a href="{{ route('audit.index') }}">Auditorias</a></li>
	 <li class="breadcrumb-item active">Nuevo</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-list-ol"></i>
                    <strong>Auditoria</strong>
                    <small>Nuevo</small>
                </div>
				{!! Form::open(['route' => ['audit.store'], 'method' => 'POST', 'class' => 'form-horizontal', 'id' =>'CreateAuditForm']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
							@include('audit.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" id="Submit" class="btn btn-primary">
                        Siguiente
                        <i class="fa fa-angle-double-right "></i>
                    </button>

                    <a id="btn-cancel" href="{{ URL::previous() }}" class="btn btn-link text-danger">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </a>
                </div>
				{!! Form::close() !!}
            </div>

        </div>
	</div>
@stop

@section('scripts')
<script>
  $('#Submit').on('click', function (e) {
        e.preventDefault();
        $('#btn-cancel').fadeOut(1);
        $(this).attr('disabled', 'disabled');
        $(this).text('Espere...')
        $('#CreateAuditForm').submit();
  })
</script>
@stop
