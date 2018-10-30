<?php

namespace EmejiasInventory\Http\Controllers\Api;

use EmejiasInventory\Entities\CashRegisterExpense;
use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Http\Requests\CashRegisterExpenseStore;
use EmejiasInventory\Http\Resources\CashRegisterExpenseResource;

class CashRegisterExpenseController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashRegisterExpenseStore $request)
    {
        $expense = CashRegisterExpense::create(request()->only('amount', 'description', 'cash_register_id'));
        return new CashRegisterExpenseResource($expense);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EmejiasInventory\Entities\CashRegisterExpense  $cashRegisterExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashRegisterExpense $cashRegisterExpense)
    {
        $cashRegisterExpense->update(request()->only('amount', 'description', 'cash_register_id'));
        return new CashRegisterExpenseResource($cashRegisterExpense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EmejiasInventory\Entities\CashRegisterExpense  $cashRegisterExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashRegisterExpense $cashRegisterExpense)
    {
        $cashRegisterExpense->delete();
        return response()->json([], 204);
    }
}
