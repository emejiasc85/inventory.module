<!-- Modal -->
<div class="modal fade" id="confirmDeleteOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm modal-danger " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alerta</h4>
            </div>
            <div class="modal-body">
                <h1>¿Estas seguro de eliminar este pedido?</h1>
            </div>
            <div class="modal-footer">
                {!! Form::open(['method' => 'DELETE', 'route' => 'orders.destroy', 'id' => 'destroyValue']) !!}
                {!! Field::hidden('order_id', null, ['id' => 'order_id']) !!}
                    <button type="button" id="delete" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>