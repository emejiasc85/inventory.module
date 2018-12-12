<?php

namespace EmejiasInventory\Http\Controllers\Api\Admin;

use EmejiasInventory\Entities\Warehouse;
use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Http\Resources\Admin\WarehouseResource;
use EmejiasInventory\Http\Requests\Admin\WarehouseStore;
use EmejiasInventory\Http\Requests\Admin\WarehouseUpdate;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::with(['commerce'])->paginateIf();
        return WarehouseResource::collection($warehouses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseStore $request)
    {
        $warehouse = Warehouse::create($request->only('name', 'description', 'commerce_id'));
        return new WarehouseResource($warehouse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EmejiasInventory\Entities\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseUpdate $request, Warehouse $warehouse)
    {
        $warehouse->update($request->only('name', 'description', 'commerce_id'));
        return new WarehouseResource($warehouse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EmejiasInventory\Entities\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
