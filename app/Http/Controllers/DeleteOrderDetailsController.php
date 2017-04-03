<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Order,OrderDetail};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class DeleteOrderDetailsController extends Controller
{
    public function destroy(Request $request, Order $order)
    {
    	//App\Flight::destroy(1);
    	OrderDetail::destroy($request->get('id'));
        Alert::success('Se ha eliminado el detalle');
    	return redirect()->back();
    }
}
