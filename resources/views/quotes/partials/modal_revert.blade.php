<!-- Modal -->
<div class="modal fade" id="ConfirmRevertOrder"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content">
            <div class="modal-header " style="border-top: 2px solid #4dbd74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel"><i class="fa fa fa-undo"></i> ¿Estas seguro de revertir la cotización? </h2>
            </div>
            {!! Form::open(['route' => ['quotes.revert', $order], 'id' => 'BillFormConfirm', 'method' => 'PUT']) !!}
            <div class="modal-footer">
                <button type="button" id="delete" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="" class="btn btn-success">Confirmar</button>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>