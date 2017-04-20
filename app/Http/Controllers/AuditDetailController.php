<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Audit;
use EmejiasInventory\Entities\AuditDetail;
use EmejiasInventory\Entities\Product;
use Illuminate\Http\Request;

class AuditDetailController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return ("hola");
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Audit $audit) {
        // return ("hola");
        $data = $request->all();
        $data = array_where($data, function ($value, $key) {
            return is_string($value);
        });

        if (empty($data)) {
            $products = [];
        } else {
            $products = Product::name($request->get('name'))
                ->id($request->get('id'))
                ->make($request->get('make_id'))
                ->group($request->get('product_group_id'))
                ->presentation($request->get('product_presentation_id'))
                ->unit($request->get('unit_measure_id'))
                ->barcode($request->get('barcode'))
                ->orderBy('id', 'DESC')
                ->get();

        }
        return compact('audit', 'products');
        return view('audit.details.create', compact('audit', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Audit $audit) {
        return request()->all();
        $rules = [
            'product_id' => 'required|exists:products,NULL,id,audit_id,' . $audit->id,
            'lot' => 'required|numeric',
        ];
        $this->validate($request, $rules);
        $data = array_add($request->all(), 'audit_id', $audit->id);
        $new_detail = AuditDetail::create($data);
        $audit->sumTotals();
        $audit->save();
        Alert::success('Producto Agregado correctamente');
        return redirect($audit->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function show(AuditDetail $auditDetail) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditDetail $auditDetail) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditDetail $auditDetail) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditDetail $auditDetail) {
        //
    }
}
