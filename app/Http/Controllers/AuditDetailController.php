<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Audit;
use EmejiasInventory\Entities\auditDetail;
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
        return view('audit.details.create', compact('audit', 'products'));
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function show(auditDetail $auditDetail) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(auditDetail $auditDetail) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, auditDetail $auditDetail) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(auditDetail $auditDetail) {
        //
    }
}
