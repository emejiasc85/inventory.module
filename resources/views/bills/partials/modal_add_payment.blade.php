<!-- Modal -->
<div class="modal fade" id="addPayment"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content">
            <div class="modal-header " style="border-top: 2px solid #4dbd74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Pagos <strong id="addProductName"></strong></h4>
            </div>
            {!! Form::open(['route' => 'payments.store', 'method' => 'POST']) !!}
            <div class="modal-body">
                {!! Field::text('amount') !!}
                {!! Field::text('baucher') !!}
                {!! Field::checkbox('deposit') !!}
                {!! Field::hidden('order_id', $order->id) !!}
            </div>
            <div class="modal-footer">
                <button type="button" id="delete" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="" class="btn btn-success">Agregar Pago</button>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>