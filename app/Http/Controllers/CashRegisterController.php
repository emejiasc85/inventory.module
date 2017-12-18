<?php

namespace EmejiasInventory\Http\Controllers;

use Illuminate\Http\Request;
use EmejiasInventory\Entities\CashRegister;
use Styde\Html\Facades\Alert;

class CashRegisterController extends Controller
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
    public function create()
    {
        return view('registers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['initial_cash' => 'nullable|numeric']);
        $open = new CashRegister();
        $open->initial_cash = $request->initial_cash;
        $open->user_id = auth()->user()->id;
        $open->save();
        return redirect()->route('bills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $register = CashRegister::orderBy('id', 'DESC')->first();
        return view('registers.edit', compact('register'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashRegister $register)
    {
        $this->validate($request, ['amount' => 'nullable|numeric']);
        $register->fill($request->all());
        $register->status = true;
        $register->user_id = auth()->user()->id;
        $register->save();
        Alert::success('Caja Cerrada');
        return redirect('/');
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
