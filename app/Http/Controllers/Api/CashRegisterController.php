<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\CashRegister;
use EmejiasInventory\Http\Resources\CashRegisterResource;
use EmejiasInventory\Http\Requests\CashRegisterStore;
use Illuminate\Support\Carbon;
use EmejiasInventory\Rules\hasOpenInvoice;

class CashRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cash_registers = CashRegister::open()
            ->id()
            ->date()
            ->orderByDesc('id')
            ->paginateIf();
        return CashRegisterResource::collection($cash_registers);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashRegisterStore $request)
    {
        $cash_register = new CashRegister();
        $cash_register->initial_cash = request()->initial_cash != '' ? request()->initial_cash:0;
        $cash_register->user_id = auth()->user()->id;
        $cash_register->save();

        return new CashRegisterResource($cash_register);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CashRegister $cash_register)
    {
        $cash_register->load('invoices.people', 'invoices.user', 'user');
        return new CashRegisterResource($cash_register);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashRegister $cash_register)
    {

        $this->validate(request(), [
            'status' => [ new hasOpenInvoice($cash_register->id)]
        ]);
        request()->merge(['closing_date' => Carbon::now(), 'user_id' =>  auth()->user()->id ]);
        $cash_register->update(request()->only(['status', 'user_id', 'closing_date']));
        $cash_register->load('invoices.people', 'invoices.user', 'user');
        return new CashRegisterResource($cash_register);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
