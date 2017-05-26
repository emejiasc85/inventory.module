<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\{Commerce,People};
use Illuminate\Http\Request;

class CreateQuotationController extends Controller
{
    public function create()
    {
        $commerce  = Commerce::first();
        return view('quotes.create', compact('commerce'));
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
         $bill->order_type_id = 4;
         $bill->people_id = $customer->id;
         $bill->user_id = auth()->user()->id;
         $bill->save();

         //return redirect()->route('quotes.details', $bill);
    }
}
