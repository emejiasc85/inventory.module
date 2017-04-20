<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\auditDetail;
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
    public function create() {
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
