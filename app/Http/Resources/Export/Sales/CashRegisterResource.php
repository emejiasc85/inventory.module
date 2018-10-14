<?php

namespace EmejiasInventory\Http\Resources\Export\Sales;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CashRegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Id'                          => $this->id,
            'Fecha apertura'              => Carbon::parse($this->created_at)->format('d/m/Y h:m:s A'),
            'Fecha Cierre'                => Carbon::parse($this->closing_date)->format('d/m/Y h:m:s A'),
            'Saldo inicial'               => $this->initial_cash,
            'Ventas'                      => number_format($this->payments->whereIn('payment_method_id', [1,2,3,4,5,6,7])->sum('amount'),2),
            'Usuario'                     => $this->user->name,
            'Creditos'                    => $this->payments->where('payment_method_id', 4)->sum('amount'),
            'Pagos a credito'             => $this->payments->whereIn('payment_method_id', [6,7])->sum('amount'),
            'Depositos'                   => number_format($this->payments->where('payment_method_id', 7)->sum('amount'),2),
            'status'                      => $this->status ? 'Cerrada': 'Abierta',
            'Pagos en efectivo'           => number_format($this->payments->where('payment_method_id', 1)->sum('amount'),2),
            'Pagos con tarjeta'           => number_format($this->payments->where('payment_method_id', 2)->sum('amount'),2),
            'Pagos con cheques'           => number_format($this->payments->where('payment_method_id', 3)->sum('amount'),2),
            'Pagos con tarjeta de regalo' => number_format($this->payments->where('payment_method_id', 5)->sum('amount'),2),
            'total efectivo'              => number_format($this->payments->whereIn('payment_method_id', [1,2,3,4,5,6,7])->sum('amount'),2)
        ];
    }
}
