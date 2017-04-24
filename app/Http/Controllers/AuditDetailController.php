<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Audit;
use EmejiasInventory\Entities\auditDetail;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Entities\Stock;
use Styde\Html\Facades\Alert;
use Illuminate\Support\Facades\Input;
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
            $products= Stock::select(['products.*'])->leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)
            ->order($request->get('order_id'))
            ->product($request->get('name'))
            ->productId($request->get('id'))
            ->dueDate($request->get('from_due'), $request->get('to_due'))
            ->stock($request->get('simbol'), $request->get('stock'))
            ->where('status', true)
            //->groupBy('id', 'DESC')
           
            ->paginate();
            // dd($products);
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
    public function store(Request $request, Audit $audit) {
        $rules = [
            'product_id' => 'required|exists:products,id',
        ];
        $this->validate($request, $rules);
       $stocks = Stock::select(['stocks.id','stocks.stock'])->leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)
            ->order($request->get('order_id'))
            ->product($request->get('name'))
            ->productId($request->get('id'))
            ->dueDate($request->get('from_due'), $request->get('to_due'))
            ->stock($request->get('simbol'), $request->get('stock'))
            ->where('status', true)
            ->where('product_id', $request->input('product_id'))
            //->OrderBy('id', 'DESC')
           
            ->paginate();
//Stock::where('id',);
$data=[];
        // dd($data, $stocks);
if(count($audit->details->where('product_id', $request->input('product_id')))>0 )
{
       Alert::danger('Alerta')->details('El Producto ya existe en la Auditoria');
        return redirect($audit->url);
}
// dd("no entro");
foreach ($stocks as $key => $value) {
// dd($value->stock);
    $data=[];
    $data = array_add($data, 'audit_id', $audit->id);
    $data = array_add($data, 'product_id',  $request->input('product_id'));
    $data = array_add($data, 'stock_id', $value->id);
    $data = array_add($data, 'current_stock', $value->stock);
    $data = array_add($data, 'audited_stock', 0);
        $new_detail = auditDetail::create($data);
}
 
        Alert::success('Producto Agregado correctamente');
        return redirect($audit->url);
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
/*         $rules = [
        'id'             => 'required|exists:order_details,id',
        'lot'            => 'required|numeric',
        'purchase_price' => 'numeric|nullable',
        'due_date'       => 'date|nullable'
    ];*/
         //$this->validate($request, $this->rules);
        $input = Input::all();
        $condition = $input['id'];
        $allOrders=array(); // make an array, for storing all detail order in it
        foreach ($condition as $key => $condition) {
            $detail = auditDetail::findOrFail($input['id'][$key]);
            $detail->audited_stock = $input['audited_stock'][$key];
            if ($detail->audited_stock==$detail->current_stock) {
                $detail->status = "ok";
            }else{
                $detail->status = "bad";
            }
            $detail->save();
        }
        Alert::success('Detalles de Auditoria editados correctamente');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Audit $audit) {

        auditDetail::destroy($request->get('id'));
        Alert::success('Se ha eliminado el detalle');
        return redirect()->back();
    }
}
