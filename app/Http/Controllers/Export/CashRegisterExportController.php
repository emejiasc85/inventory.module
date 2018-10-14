<?php

namespace EmejiasInventory\Http\Controllers\Export;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\CashRegister;
use Maatwebsite\Excel\Facades\Excel;
use EmejiasInventory\Http\Resources\Export\Sales\CashRegisterResource;

class CashRegisterExportController extends Controller
{
    public function index(Request $request)
    {
        $cash_registers = CashRegister::open()
        ->id()
        ->date()
        ->orderByDesc('id')
        ->get();
        Excel::create('reporte', function ($excel) use ($cash_registers) {
            $excel->sheet('ventas', function ($sheet) use ($cash_registers) {
                $sheet->fromArray(collect(CashRegisterResource::collection($cash_registers)));
            });
        })->export('xls');
    }
}
