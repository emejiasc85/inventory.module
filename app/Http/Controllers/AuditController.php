<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Audit,Commerce,OrderType,User,Stock,auditDetail};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class AuditController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $audits = Audit::id(request()->get('id'))->orderBy('id', 'DESC')->paginate();
        return view('audit.index', compact('audits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $commerce = Commerce::first();
        $users = User::pluck('name', 'id')->toArray();
        $types = OrderType::pluck('name', 'id')->toArray();
        return view('audit.create', compact('commerce', 'types', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, ['user_id' => 'required']);

        $request->request->add(['user_id' => auth()->user()->id]);

        $audit = Audit::create($request->all());

        if($request->type)
        {
            $this->auditAllProducts($audit);
        }

        Alert::success('Auditoria Creada')->details('Agrega los detalles');
        return redirect()->route('audit.show', $audit);
    }

    public function auditAllProducts(Audit $audit)
    {
        $stocks = Stock::select('stocks.id','stocks.stock', 'order_details.product_id')
            ->leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->where('warehouse_id', 1)
            ->where('status', true)
            ->get();

        foreach ($stocks as $key => $value)
        {
            auditDetail::create([
                'audit_id'      => $audit->id,
                'product_id'    => $value->product_id,
                'stock_id'      => $value->id,
                'current_stock' => $value->stock,
                'audited_stock' => 0
            ]);
        }

        return $audit->details;
    }

    /**
     * Display the specified resource.
     *
     * @param  \EmejiasInventory\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function show(Audit $audit) {
        return view('audit.show', compact('audit'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EmejiasInventory\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function edit(Audit $audit) {
        $commerce = Commerce::first();
        $users = User::pluck('name', 'id')->toArray();
        $types = OrderType::pluck('name', 'id')->toArray();
        return view('audit.edit', compact('commerce', 'types', 'users', 'audit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EmejiasInventory\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audit $audit) {
        // dd($request->all());
        // $this->validate($request, ['user_id' => 'required']);
        $audit->fill($request->all());
        $audit->save();
        Alert::success('Auditoria editada correctamente');
        return redirect($audit->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EmejiasInventory\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audit $audit) {
        //
    }
}
