<!-- Modal -->
<div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog modal-sm modal-default " role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">Alerta</h4>
	      	</div>
	    	<div class="modal-body">
                <p>Se cambiara el estado del Pedido</p>
		        <p>¿Esta seguro?</p>
	    	</div>
	      	<div class="modal-footer">
	        	{!! Form::open(['method' => 'put', 'route' => ['orders.updateStatus', $audit]]) !!}
					{!! Field::hidden('status', null, ['id' => 'value_status']) !!}
	        		<button type="button" id="delete" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        		<button id="buttonStatus" type="submit" {!! Html::classes([
                            'btn',
                            'btn-primary' => $audit->status == 'Creado',
                            'btn-success' => $audit->status == 'Solicitado',
                            'btn-warning' => $audit->status == 'Ingresado',
                        ]) !!}>
                        @if ($audit->status == 'Creado')
                            Solicitar
                        @elseif ($audit->status == 'Solicitado')
                            Ingresar
                        @elseif ($audit->status == 'Ingresado')
                            Revertir
                        @endif
                        <i class="fa fa-angle-double-right"></i>

                    </button>
				{!! Form::close() !!}
	      	</div>
    	</div>
  	</div>
</div>