<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Audit;
use EmejiasInventory\Entities\Commerce;
use EmejiasInventory\Entities\OrderType;
use EmejiasInventory\Entities\User;
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
        // dd(request()->all());
        $this->validate($request, ['user_id' => 'required']);
        $data = array_add($request->all(), 'user_id', auth()->user()->id);
        // dd($data);
        $new_audit = Audit::create($data);
        Alert::success('Pedido Creado')->details('Agrega los detalles');
        return redirect()->route('audit.show', $new_audit);
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
        Alert::success('Pedido editada correctamente');
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
