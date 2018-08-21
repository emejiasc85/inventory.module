<?php

namespace EmejiasInventory\Http\Controllers;

use Carbon\Carbon;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Entities\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use EmejiasInventory\Entities\People;

class ReportsController extends Controller
{
    public function sellers(Request $request)
    {
        $users = User::pluck('name', 'id')->toArray();
        $sellers = Order::selectRaw('users.name, count(orders.id) as sales, sum(orders.total) as totals')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->where('order_type_id', 2)
            ->date($request->from, $request->to)
            //->sales($request->get('simbol'), $request->get('sales'))
            ->userName($request->name)
            ->groupBy('users.name')
            ->orderBy('totals', ($request->order == null ? 'DESC': $request->order))
            ->paginate();
        return view('reports.sellers', compact('sellers', 'users'));
    }

    public function products(Request $request)
    {
        $products = OrderDetail::topProducts($request)->paginate();
        return view('reports.products', compact('products'));
    }

    public function productsDownload(Request $request)
    {
        $products = OrderDetail::topProducts($request)->get();

        Excel::create('Top productos ', function($excel) use($products) {
            $excel->sheet('Productos', function($sheet) use($products) {
                $sheet->loadView('reports.partials.table', compact('products'));
            });
        })->export('xls');
    }

    public function productsGroupByDate(Request $request)
    {
        $products = OrderDetail::topProductsByDate($request)->paginate();

        return view('reports.products_by_date', compact('products'));
    }

    public function productsGroupByDateDownload(Request $request)
    {
        $products = OrderDetail::topProductsByDate($request)->get();

        Excel::create('Top productos por fecha ', function($excel) use($products) {
            $excel->sheet('productos', function($sheet) use($products) {
                $sheet->loadView('reports.partials.table_by_date', compact('products'));
            });
        })->export('xls');
    }

    public function dueDate(Request $request)
    {

        $stocks = Stock::leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)
            ->where('due_date', '!=', null)
            ->order($request->get('order_id'))
            ->product($request->get('name'))
            ->productId($request->get('id'))
            ->dueDate(Carbon::now(), Carbon::now()->addMonths(8))
            ->stock($request->get('simbol'), $request->get('stock'))
            ->where('status', true)
            ->OrderBy('due_date', 'ASC')
            ->get();


        return view('stocks.due_date', compact('stocks'));
    }

    public function minStock(Request $request)
    { $stocks = Stock::leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)

            ->order($request->get('order_id'))
            ->product($request->get('name'))
            ->productId($request->get('id'))
            ->stock('<=', 5)
            ->where('status', true)
            ->OrderBy('due_date', 'ASC')
            ->get();

        return view('stocks.min_stock', compact('stocks'));
    }

    public function resumen(Request $request)
    {
        $orders = Order::where('status', 'Ingresado')->where('order_type_id', 1)->orWhere('order_type_id', 2)->paginate();
        return view('reports.resumen', compact('orders'));
    }

    public function topCustomers(Request $request)
    {
        $people = People::paginate();
        return view('reports.top_customers', compact('people'));
    }

    public function topCustomersDownload(Request $request)
    {
        $people = People::topCustomers($request)->get();
        Excel::create('Top clientes ', function($excel) use($people) {
            $excel->sheet('clientes', function($sheet) use($people) {
                $sheet->loadView('reports.partials.table_top_customers', compact('people'));
            });
        })->export('xls');


    }
}
