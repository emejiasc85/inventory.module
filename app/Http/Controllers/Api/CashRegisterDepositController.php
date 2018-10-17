<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\CashRegisterDeposit;
use EmejiasInventory\Http\Resources\CashRegisterDepositResource;
use EmejiasInventory\Http\Requests\CashRegisterDepositStore;

class CashRegisterDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $deposits = CashRegisterDeposit::cashRegister()->get();
        return CashRegisterDepositResource::collection($deposits);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashRegisterDepositStore $request)
    {
        $deposit = CashRegisterDeposit::create(request()->all());
        return new CashRegisterDepositResource($deposit);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashRegisterDeposit $cash_register_deposit)
    {
        $cash_register_deposit->delete();
        return response()->json([], 204);
    }
}
