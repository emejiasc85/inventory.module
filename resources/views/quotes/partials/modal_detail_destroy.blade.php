<!-- Modal -->
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog modal-sm modal-danger " role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">Alerta</h4>
	      	</div>
	    	<div class="modal-body">
	    		<p id="ProductName"></p>
		        <p>¿Esta seguro de eliminar este producto de la  cotización?</p>
	    	</div>
	      	<div class="modal-footer">
	        	{!! Form::open(['method' => 'DELETE', 'route' => ['quotes.details.destroy', $order], 'id' => 'destroyValue']) !!}
					{!! Field::hidden('id', null, ['id' => 'value_id']) !!}
	        		<button type="button" id="delete" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        		<button type="submit" class="btn btn-danger">Eliminar</button>
				{!! Form::close() !!}
	      	</div>
    	</div>
  	</div>
</div>