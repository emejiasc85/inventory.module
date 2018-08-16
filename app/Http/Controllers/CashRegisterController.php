<?php

namespace EmejiasInventory\Http\Controllers;

use Illuminate\Http\Request;
use EmejiasInventory\Entities\CashRegister;
use Styde\Html\Facades\Alert;
use EmejiasInventory\Entities\{CashRegisterDeposit,Order};
use EmejiasInventory\Entities\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use EmejiasInventory\Entities\Commerce;

class CashRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::pluck('name', 'id')->toArray();

        $registers = CashRegister::
        id($request->cash_register_id)
        ->user($request->user_id)
        ->date($request->from, $request->to)
        ->orderBy('id', 'ASC')
        ->paginate();
        return view('registers.index', compact('registers', 'users'));
    }

    public function download(Request $request)
    {
        $registers = CashRegister::
        id($request->cash_register_id)
        ->user($request->user_id)
        ->date($request->from, $request->to)
        ->get();

        Excel::create('Ventas', function($excel) use($registers) {
            $excel->sheet('Ventas', function($sheet) use($registers) {
                $sheet->loadView('registers.partials.table', compact('registers'));
            });

        })->export('xls');
        return view('registers.partials.table', compact('registers'));
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

        $open_register = CashRegister::where('status', false)->get();

        if($open_register->count() > 0){
            Alert::warning('No puede aperturar mas de una caja a la vez');
            return redirect('/');
        }


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
    public function edit(CashRegister $register)
    {
        $commerce = Commerce::first();
        return view('registers.edit', compact('register', 'commerce'));
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
        $register->user_id = auth()->user()->id;
        $register->save();
        Alert::success('Saldo inicial editado');
        return redirect()->back();
    }
    public function close(Request $request, CashRegister $register)
    {

        $register->status = true;
        $register->closing_date = Carbon::now();
        $register->user_id = auth()->user()->id;
        $register->save();
        Alert::success('Caja Cerrada');
        return redirect()->back();
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

    public function bills(Request $request, CashRegister $register)
    {
        return view('registers.bills', compact('register'));
    }
    public function credits(CashRegister $register)
    {
        return view('registers.credits', compact('register'));
    }
    public function payments(CashRegister $register)
    {
        return view('registers.payments', compact('register'));
    }


    public function SalesToCashRegister()
    {
        DB::transaction(function ()
        {
            dd(Order::query()
            ->where('order_type_id', 2)
            ->where('cash_register_id', null)
            ->get());
            $registers = CashRegister::all();

            foreach($registers as $register){

                $orders = Order::query()
                    ->whereBetween('created_at', [$register->created_at, $register->updated_at])
                    ->where('order_type_id', 2)
                    ->where('cash_register_id', null)
                    ->get();

                if ($orders->count()>0)
                {
                    foreach($orders as $order)
                    {
                        $order->cash_register_id = $register->id;
                        $order->save();
                    }
                }
            }

            Alert::success('Se agregaron las ventas faltantes a las cajas correspondientes');

        });
        return redirect()->route('index');
    }


    public function report(Request $request)
    {
        $users = User::pluck('name', 'id')->toArray();
        $commerce = Commerce::first();
        $registers = CashRegister::
        id($request->cash_register_id)
        ->user($request->user_id)
        ->date($request->from, $request->to)
        ->where('status', true)
        ->with('orders.details')
        ->get();
        $sales = Order::whereIn('cash_register_id', $registers->pluck('id')->toArray())->get();
        return view('registers.report', compact('registers', 'sales', 'users', 'commerce'));
    }
}
