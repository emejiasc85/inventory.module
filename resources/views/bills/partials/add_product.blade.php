<!-- Modal -->
<div class="modal fade" id="addProduct"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content">
            <div class="modal-header " style="border-top: 2px solid #4dbd74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa fa-shopping-cart"></i> Agregar <strong id="addProductName"></strong></h4>

            </div>
            {!! Form::open(['route' => ['bills.details.store', $order], 'id' => 'AddProductForm', 'method' => 'POST']) !!}
            <div class="modal-body">
                {!! Field::number('lot', 1, ['min' => 0, 'step' => 1, 'required']) !!}
                {!! Field::text('sale_price') !!}
                {!! Field::hidden('product_id', null, ['id' => 'product_id']) !!}
            </div>
            <div class="modal-footer">
                <button type="button" id="delete" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="AddProductButton" class="btn btn-success">Agregar</button>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>