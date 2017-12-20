<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Commerce,People, Order};
use Illuminate\Http\Request;
use EmejiasInventory\Entities\CashRegister;
use Styde\Html\Facades\Alert;

class CreateBillController extends Controller
{
    public function create()
    {
        $open_register= CashRegister::where('status', false)->orderBy('id', 'DESC')->get();
        
        if($open_register->count() == 0){
            Alert::warning('Debe aperturar una caja antes de realizar ventas');
    
            return redirect()->route('cash.registers.create');

        }  
        
        $register = $open_register->first();
        $commerce  = Commerce::first();
        return view('bills.create', compact('commerce'));
    }

    public function store(Request $request)
    {
        $open_register= CashRegister::where('status', false)->orderBy('id', 'DESC')->get();
        
        $register = $open_register->first()->id;         

        $this->validate($request, ['nit' => 'required', 'name' => 'required', 'address' => 'required']);

        $customer = People::updateOrCreate([
            'nit' => $request->get('nit')
        ],[
            'name' => $request->get('name'),
            'address' => $request->get('address'),
        ]);

         $bill = new Order();
         $bill->cash_register_id = $register;
         $bill->order_type_id = 2;
         $bill->people_id = $customer->id;
         $bill->user_id = auth()->user()->id;
         $bill->save();

         return redirect()->route('bills.details', $bill);
    }

    public function storeByProfile(People $people)
    {
        $bill = new Order();
        $bill->order_type_id = 2;
        $bill->people_id = $people->id;
        $bill->user_id = auth()->user()->id;
        $bill->save();

        return redirect()->route('bills.details', $bill);
    }
}
