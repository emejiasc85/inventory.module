<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\ProductSerie;
use Illuminate\Http\Request;
use EmejiasInventory\Http\Requests\ProductSerieStoreRequest;
use Styde\Html\Facades\Alert;
use EmejiasInventory\Http\Requests\ProductSerieUpdateRequest;

class ProductSerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = ProductSerie::search()->paginate();
        return view('product_series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductSerieStoreRequest $request)
    {
        $serie = ProductSerie::create($request->only(['name', 'description']));
        Alert::success('Agregado correctamente');
        return redirect()->route('product_series.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EmejiasInventory\Entities\ProductSerie  $product_series
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSerie $product_series)
    {
        return view('product_series.edit', compact('product_series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EmejiasInventory\Entities\ProductSerie  $productSerie
     * @return \Illuminate\Http\Response
     */
    public function update(ProductSerieUpdateRequest $request, ProductSerie $product_series)
    {
        $product_series->update($request->only(['name', 'description']));
        Alert::success('Editado correctamente');
        return redirect()->route('product_series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EmejiasInventory\Entities\ProductSerie  $productSerie
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSerie $productSerie)
    {
        //
    }
}
