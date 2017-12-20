<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\CashRegisterDeposit;
use Illuminate\Http\Request;
use EmejiasInventory\Entities\CashRegister;
use Styde\Html\Facades\Alert;

class CashRegisterDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CashRegister $register)
    {
        $this->validate($request, ['bank' => 'nullable', 'account' => 'nullable', 'amount' => 'required|numeric|min:0', 'baucher' => 'required', 'date' => 'required|date']);
        $request->request->add(['cash_register_id' => $register->id]);
        $deposit = CashRegisterDeposit::create($request->all());
        Alert::success('Deposito Agregado');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \EmejiasInventory\Entities\CashRegisterDeposit  $cashRegisterDeposit
     * @return \Illuminate\Http\Response
     */
    public function show(CashRegisterDeposit $cashRegisterDeposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EmejiasInventory\Entities\CashRegisterDeposit  $cashRegisterDeposit
     * @return \Illuminate\Http\Response
     */
    public function edit(CashRegisterDeposit $cashRegisterDeposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EmejiasInventory\Entities\CashRegisterDeposit  $cashRegisterDeposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashRegisterDeposit $cashRegisterDeposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EmejiasInventory\Entities\CashRegisterDeposit  $cashRegisterDeposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deposit = CashRegisterDeposit::findOrFail($request->deposit_id);
        $deposit->delete();
        Alert::success('Deposito eliminado');
        return redirect()->back();
    }
}
