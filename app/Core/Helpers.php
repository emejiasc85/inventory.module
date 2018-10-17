<?php

use EmejiasInventory\Entities\Product;

function updateStock($inventory, $lot){
    $inventory = Stock::findOrFail($inventory);

    if($lot >  $inventory->stock){
        $out = $lot -$inventory->stock;
        $inventory->stock = 0;
        $inventory->status = false;
    }
    else{
        $out = 0;
        $inventory->stock = $inventory->stock - $lot;
    }
    $inventory->save();

    return $out;
}

function generateBarcodeNumber(int $id) {
    $id = sprintf('%04d', $id);
    $number = mt_rand(100000, 999999).$id;

    if (barcodeNumberExists($number)) {
        return generateBarcodeNumber();
    }
    return $number;
}

function barcodeNumberExists($number) {
    return Product::whereBarcode($number)->exists();
}
