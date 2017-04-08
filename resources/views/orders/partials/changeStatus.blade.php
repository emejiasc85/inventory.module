<!-- Modal -->
<div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog modal-sm modal-default " role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">Alerta</h4>
	      	</div>
	    	<div class="modal-body">
                <p>Se cambiara el estado de la orden</p>
		        <p>¿Esta seguro?</p>
	    	</div>
	      	<div class="modal-footer">
	        	{!! Form::open(['method' => 'put', 'route' => ['orders.updateStatus', $order]]) !!}
					{!! Field::hidden('status', null, ['id' => 'value_status']) !!}
	        		<button type="button" id="delete" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        		<button id="buttonStatus" type="submit" {!! Html::classes([
                            'btn',
                            'btn-primary' => $order->status == 'Creado',
                            'btn-success' => $order->status == 'Solicitado',
                        ]) !!}>
                        @if ($order->status == 'Creado')
                            Solicitar
                        @elseif ($order->status == 'Solicitado')
                            Ingresar
                        @endif
                        <i class="fa fa-angle-double-right"></i>

                    </button>
				{!! Form::close() !!}
	      	</div>
    	</div>
  	</div>
</div>