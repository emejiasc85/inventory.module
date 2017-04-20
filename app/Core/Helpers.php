<?php

function updateStock($inventory, $lot)
{
    $inventory = Stock::findOrFail($inventory);

    if($lot >  $inventory->stock)
    {
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