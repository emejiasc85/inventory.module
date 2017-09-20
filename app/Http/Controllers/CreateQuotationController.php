<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Commerce,People,Order,Quotation};
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

         $order = new Order();
         $order->order_type_id = 4;
         $order->people_id = $customer->id;
         $order->user_id = auth()->user()->id;
         $order->save();

         Quotation::create(['order_id' => $order->id]);

         return redirect()->route('quotes.details', $order);
    }
}
