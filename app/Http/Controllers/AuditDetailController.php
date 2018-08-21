<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Audit;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Entities\auditDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Styde\Html\Facades\Alert;

class AuditDetailController extends Controller {

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

        $products = [];

        if (!empty($data)) {
            $products = Product::name($request->get('name'))
                ->id($request->get('id'))
                ->makes($request->get('make_id'))
                ->group($request->get('product_group_id'))
                ->presentation($request->get('product_presentation_id'))
                ->unit($request->get('unit_measure_id'))
                ->barcode($request->get('barcode'))
                ->orderBy('id', 'DESC')
                ->get();

        }

        return view('audit.details.create', compact('audit', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Audit $audit) {

        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
        ]);

        if($audit->details->where('product_id', $request->product_id)->count() > 0 )
        {
            Alert::danger('Alerta')->details('El Producto ya existe en la Auditoria');
            return redirect($audit->url);
        }

        $stocks = Stock::select(['stocks.id','stocks.stock'])->leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)
            ->productId($request->id)
            ->product($request->name)
            ->order($request->order_id)
            ->dueDate($request->from_due, $request->to_due)
            ->stock($request->simbol, $request->stock)
            ->where('product_id', $request->product_id)
            ->where('status', true)
            ->get();

        $this->addDetails($request, $stocks, $audit);

        Alert::success('Producto Agregado correctamente');
        return redirect($audit->url);
    }

    public function addDetails(Request $request, $stocks, Audit $audit)
    {

        foreach ($stocks as $key => $value)
        {
            auditDetail::create([
                'audit_id'      => $audit->id,
                'product_id'    => $request->input('product_id'),
                'stock_id'      => $value->id,
                'current_stock' => $value->stock,
                'audited_stock' => 0
            ]);
        }

        return $audit->details;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, auditDetail $auditDetail) {
        $rules = [
            'id'            => 'required|exists:order_details,id',
            'audited_stock' => 'required|numeric|integer|min:0',
        ];
        $input = Input::all();
        $condition = $input['id'];
        $allOrders=array(); // make an array, for storing all detail order in it
        foreach ($condition as $key => $condition) {
            $validation=[
                'id'            =>$input['id'][$key],
                'audited_stock' =>$input['audited_stock'][$key],
            ];
            $detail = auditDetail::findOrFail($input['id'][$key]);
            $validator = Validator::make($validation, $rules);
            if ($validator->fails())
            {
                $validator->errors()->add('', 'Se Encuentra en el producto '.$detail->product->name);
                return redirect()->back()->withErrors($validator);
            }
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
