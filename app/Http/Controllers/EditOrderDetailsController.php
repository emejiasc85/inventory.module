<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\OrderDetail;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditOrderDetailsController extends Controller
{
    protected $rules = [
        'lot'      => 'required|numeric',
        'cost'     => 'numeric|nullable',
        'due_date' => 'date|nullable'
    ];
    public function update(Request $request, OrderDetail $detail)
    {
        $this->validate($request, $this->rules);
        $detail->fill($request->all());
        $detail->save();
        $detail->order->sumTotals();
        $detail->order->save();
        Alert::success('Detalle Editado correctamente');
        return redirect()->back();
    }
}
