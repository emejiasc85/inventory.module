<?php

namespace EmejiasInventory\Http\Controllers;

use Illuminate\Http\Request;

class BillController extends Controller
{
    public function details(Order $order)
    {
        return view('bills.details', $order);
    }
}
