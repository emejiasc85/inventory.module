<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Commerce,People, Order};
use Illuminate\Http\Request;

class CreateBillController extends Controller
{
    public function create()
    {
        $commerce  = Commerce::first();
        return view('bills.create', compact('commerce'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['nit' => 'required', 'name' => 'required', 'address' => 'required']);

        $customer = People::updateOrCreate([
            'nit' => $request->get('nit')
        ],[
            'name' => $request->get('name'),
            'address' => $request->get('address'),
        ]);

         $bill = new Order();
         $bill->order_type_id = 2;
         $bill->people_id = $customer->id;
         $bill->user_id = auth()->user()->id;
         $bill->save();

         return redirect()->route('bills.details', $bill);
    }
}
