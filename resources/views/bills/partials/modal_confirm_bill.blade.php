<!-- Modal -->
<div class="modal fade" id="ConfirmBill"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header " style="border-top: 2px solid #4dbd74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa fa-shopping-cart"></i> Confirmar <strong id="addProductName"></strong>
                </h4>
            </div>
            {!! Form::model($order, ['route' => ['bills.confirm', $order], 'id' => 'BillFormConfirm', 'method' => 'PUT']) !!}
            <div class="modal-body">
                {!! Field::text('bill_number', $order->bill ? $order->bill->bill:null ) !!}
                <label class="radio-inline hideVoucher" title="Efectivo">
                <input   {{ ($order->payments->where('payment_method_id',1 )->count() > 0 || $order->payments->count()  == 0 ) ? 'checked="checked"': 'false' }} type="radio" name="payment_method_id" value="1"> <i class="fa fa-money"></i> Efectivo
                </label>
                <label class="radio-inline showVoucher" title="Tarjeta" >
                    <input {{ ($order->payments->where('payment_method_id',2 )->count() > 0) ? 'checked="checked"': 'false' }} type="radio" name="payment_method_id" value="2"> <i class="fa fa-credit-card"></i> Tarjeta
                </label>
                <label class="radio-inline showVoucher" title="Cheque" >
                    <input {{ ($order->payments->where('payment_method_id',3 )->count() > 0) ? 'checked="checked"': 'false' }} type="radio" name="payment_method_id" value="3"> <i class="fa fa-bank" ></i> Cheque
                </label>
                <label class="radio-inline hideVoucher" title="Cheque">
                    <input {{ ($order->payments->where('payment_method_id',4 )->count() > 0) ? 'checked="checked"': 'false' }} type="radio" name="payment_method_id" value="4"> <i class="fa fa-inbox"></i> Credito
                </label>
                <br>
                <br>
                <div class="collapse" id="collapseVoucher">
                    <div class="well">
                        {!! Field::text('voucher') !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="delete" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="" class="btn btn-success">Confirmar</button>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>