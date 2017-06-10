<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Order,OrderDetail};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Styde\Html\Facades\Alert;

class DeleteQuotationDetailsController extends Controller
{
    public function destroy(Request $request, Order $order)
    {
        DB::beginTransaction();
        $details = OrderDetail::destroy($request->get('id'));
        $order->sumTotals();
        $order->save();
        DB::commit();

        Alert::success('Se ha eliminado el detalle');
        return redirect()->back();
    }
}
