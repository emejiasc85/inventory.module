<?php

namespace EmejiasInventory\Http\Resources;

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
            'id'                 => $this->id,
            'initial_cash'       => $this->initial_cash,
            'user_id'            => $this->user,
            'status'             => $this->status,
            'baucher'            => $this->baucher,
            'amount'             => $this->amount,
            'closing_date'       => $this->closing_date,
            'invoices'           => InvoiceResource::collection($this->whenLoaded('invoices')),
            'sales'              => $this->invoices->sum('final_total'),
            'credit_payments'    => $this->payments->whereIn('payment_method_id', [6,7])->sum('amount'),
            'total_credits'      => $this->payments->where('payment_method_id', 4)->sum('amount'),
            'total'              => number_format($this->initial_cash + $this->payments->whereIn('payment_method_id', [1,2,3,4,5,6,7])->sum('amount') + $this->payments->where('payment_method_id', 6)->sum('amount'),2),
            'created_at'         => Carbon::parse($this->created_at)->format('d/m/Y h:m:s A'),
            'closing_date'       => Carbon::parse($this->closing_date)->format('d/m/Y h:m:s A'),
            'cash_payments'      => number_format($this->payments->where('payment_method_id', 1)->sum('amount'),2),
            'card_payments'      => number_format($this->payments->where('payment_method_id', 2)->sum('amount'),2),
            'check_payments'     => number_format($this->payments->where('payment_method_id', 3)->sum('amount'),2),
            //'credit_payments'    => number_format($this->payments->where('payment_method_id', 4)->sum('amount'),2),
            'gift_card_payments' => number_format($this->payments->where('payment_method_id', 5)->sum('amount'),2),
            'credit_abones'      => number_format($this->payments->where('payment_method_id', 6)->sum('amount'),2),
            'deposits'           => number_format($this->payments->where('payment_method_id', 7)->sum('amount'),2),
            'sub_total'          => number_format($this->payments->whereIn('payment_method_id', [1,2,3,4,5,6,7])->sum('amount'),2),
            'total_cash'         => number_format($this->payments->whereIn('payment_method_id', [1,2,3,4,5,6,7])->sum('amount'),2),
            'cr_deposits' => CashRegisterDepositResource::collection($this->deposits),
        ];
    }
}
