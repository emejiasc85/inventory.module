<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Stock;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StocksController extends Controller
{
    public function index(Request $request)
    {
        $stocks = Stock::select('products.id', 'products.name', 'products.slug', 'products.price', 'products.offer_price', 'status')
            ->selectRaw('SUM(stocks.stock) as stock, unit_measures.name as unit, product_series.name as serie, makes.name as make, product_groups.name as product_group, product_presentations.name as presentation')
            ->leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('makes', 'makes.id', '=', 'products.make_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'products.product_group_id')
            ->leftJoin('product_series', 'product_series.id', '=', 'products.product_serie_id')
            ->leftJoin('unit_measures', 'unit_measures.id', '=', 'products.unit_measure_id')
            ->leftJoin('product_presentations', 'product_presentations.id', '=', 'products.product_presentation_id')
            ->where('warehouse_id', 1)
            ->order($request->order_id)
            ->ProductBarcode($request->barcode)
            ->product($request->name)
            ->presentationId($request->product_presentation_id)
            ->groupId($request->product_group_id)
            ->makeId($request->make_id)
            ->dueDate($request->from_due, $request->to_due)
            ->stock($request->simbol, $request->stock)
            ->where('status', true)
            ->groupBy('products.id', 'products.name', 'products.slug', 'unit_measures.name', 'products.price', 'products.offer_price', 'stocks.status', 'makes.name', 'product_series.name', 'product_groups.name', 'product_presentations.name')
            ->paginate();
        return view('stocks.index', compact('stocks'));
    }

    public function byOrder(Request $request)
    {
        $stocks = Stock::leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)
            ->order($request->order_id)
            ->ProductBarcode($request->barcode)
            ->product($request->name)
            ->productId($request->id)
            ->dueDate($request->from_due, $request->to_due)
            ->stock($request->simbol, $request->stock)
            ->where('status', true)
            ->OrderBy('products.id', 'DESC')
            ->paginate();
         return view('stocks.byOrder', compact('stocks'));
    }


    public function download(Request $request)
    {
        $stocks = Stock::select('products.id', 'products.name', 'products.slug', 'products.price', 'status')
            ->selectRaw('SUM(stocks.stock) as stock, makes.name as make, product_groups.name as product_group, product_presentations.name as presentation')
            ->leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('makes', 'makes.id', '=', 'products.make_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'products.product_group_id')
            ->leftJoin('product_presentations', 'product_presentations.id', '=', 'products.product_presentation_id')
            ->where('warehouse_id', 1)
            ->order($request->order_id)
            ->ProductBarcode($request->barcode)
            ->product($request->name)
            ->productId($request->id)
            ->dueDate($request->from_due, $request->to_due)
            ->stock($request->simbol, $request->stock)
            ->where('status', true)
            ->groupBy('products.id', 'products.name', 'products.slug', 'products.price', 'stocks.status', 'makes.name', 'product_groups.name', 'product_presentations.name')
            ->get();

        Excel::create('inventario', function($excel) use($stocks) {
            $excel->sheet('Inventario', function($sheet) use($stocks) {
                $sheet->loadView('stocks.partials.table', compact('stocks'));
            });

        })->export('xls');
    }

    public function byOrderDownload(Request $request)
    {
        $stocks = Stock::leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)
            ->order($request->order_id)
            ->ProductBarcode($request->barcode)
            ->product($request->name)
            ->productId($request->id)
            ->dueDate($request->from_due, $request->to_due)
            ->stock($request->simbol, $request->stock)
            ->where('status', true)
            ->OrderBy('products.id', 'DESC')
            ->get();


        Excel::create('inventario', function($excel) use($stocks) {
            $excel->sheet('Inventario', function($sheet) use($stocks) {
                $sheet->loadView('stocks.partials.tableByOrder', compact('stocks'));
            });

        })->export('xls');
    }
}
