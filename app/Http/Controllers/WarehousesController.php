<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Warehouse;
use Illuminate\Http\Request;

class WarehousesController extends Controller
{
    public function index(Request $request)
    {
    	$warehouses = Warehouse::name($request->get('name'))->orderBy('id', 'DESC')->paginate();
    	return view('warehouses.index', compact('warehouses'));
    }
}
