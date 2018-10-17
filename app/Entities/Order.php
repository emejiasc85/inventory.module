<?php
namespace EmejiasInventory\Entities;

use Carbon\Carbon;
use EmejiasInventory\Traits\OrderTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Entity
{
    use OrderTrait, SoftDeletes;

    protected $fillable = [
    	'status',
    	'user_id',
    	'people_id',
    	'total',
        'total_offer',
        'final_total',
    	'order_type_id',
        'priority',
        'credit',
        'cash_register_id',
    ];

    protected $date = ['created_at', 'updated_at'];

    public function gift_cards()
    {
        return $this->belongsToMany(GiftCard::class);
    }

    public function bill()
    {
        return $this->hasOne(Bill::class)->where('status', true);
    }

	public function setOrderTypeIdAttribute($value)
    {
        $this->attributes['order_type_id'] = $value;
    }

    public function cash_register()
    {
        return $this->belongsTo(CashRegister::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function quotation()
    {
        return $this->hasOne(Quotation::class);
    }
    public function type()
    {
        return $this->belongsTo(OrderType::class, 'order_type_id');
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function people()
    {
        return $this->belongsTo(People::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function getUrlAttribute()
    {
        return route('orders.show', $this);
    }
    public function getUrlBillAttribute()
    {
        return route('bills.details', $this);
    }

    public function getUrlQuotationAttribute()
    {
        return route('quotes.details', $this);
    }
    public function getEditUrlAttribute()
    {
    	return route('orders.edit', $this);
    }
    public function scopeId($query)
    {
        return $query->when(request()->has('id'), function($q) {
            $q->where('id', request()->id);
        });
    }
    public function scopeStatus($query, $value)
    {
        if (trim($value) != null) {
            return $query->where('status', $value);
        }
    }
    public function scopePriority($query, $value)
    {
        if (trim($value) != null) {
            return $query->where('priority', $value);
        }
    }

    public function sumTotals()
    {
        $details = $this->details->sum('total_purchase');
        $gift_cards = $this->gift_cards->sum('value');
        $this->total = $details + $gift_cards;
        return $this->total;
    }
    public function sumOfferTotals()
    {
        $details = $this->details->sum('total_offer_purchase');
        $gift_cards = $this->gift_cards->sum('value');
        $this->total_offer = $details + $gift_cards;
        return $this->total_offer;
    }

    public function setFinalTotal()
    {
        $details = $this->details->sum('total_offer_purchase');
        $gift_cards = $this->gift_cards->sum('value');
        $this->final_total = $details + $gift_cards;
        return $this->final_total;
    }

    public function scopeDate($query)
    {
        return $query->when( request()->has('from') && request()->has('to') ,function($q){
            $from = Carbon::parse(request()->from)->startOfDay();  //2016-09-29 00:00:00.000000
            $to = Carbon::parse(request()->to)->endOfDay(); //2016-09-29 23:59:59.000000
            $q->whereBetween('orders.created_at', [$from, $to]);
        });

    }
    public function scopeCredit($query)
    {
        $query->when(request()->has('credit'), function($q){
            $q->where('orders.credit', true);

        });
    }
    public function scopeTotal($query, $simbol, $field)
    {
        if(trim($simbol) != "" && trim($field) != "")
        {
            $query->where('total', $simbol, $field);
        }
    }

    public function scopeSales($query, $simbol, $field)
    {
        if(trim($simbol) != "" && trim($field) != "")
        {
            $query->where('totals', $simbol, $field);
        }
    }

    public function scopeUserName($query, $value)
    {
        if (trim($value) != null) {
            return $query->where('users.name', 'LIKE', "%$value%");
        }
    }
    public function scopePeopleName($query)
    {
        return $query->when(request()->has('people_name'), function($q) {
            $q->Join('people', 'people.id', '=', 'orders.people_id' )
                ->where('people.name', 'LIKE', '%'.request()->people_name.'%');
        });
    }

    public function scopePeopleId($query, $value)
    {
        if (trim($value) != null) {
            $query->leftJoin('people', 'people.id', '=', 'orders.people_id' )
                ->where('people.id', $value);
            return $query;
        }
    }

    public function canRevert()
    {
        if($this->status == 'Ingresado'){
            foreach ($this->details as $detail) {
                $stock = Stock::where('order_detail_id', $detail->id)->first();
                $history = StockHistory::where('stock_id', $stock->id)->get();
                if(sizeof($history) != 0){
                    return false;
                }
            }
        }

        foreach ($this->details as $detail) {
           Stock::where('order_detail_id', $detail->id)->delete();
        }

        return true;
    }

    public function scopePaymentMethod($query, $id)
    {
        if(trim($id) != '')
        {
            $query->whereHas('payments', function($q) use($id){
                $q->where("payment_method_id",  $id);
            });
        }
    }

    public function scopeCashRegisterId($query)
    {
        return $query->when(request()->has('cash_register_id'), function($q) {
            $q->where('cash_register_id', request()->cash_register_id);
        });
    }

    /* invoice methods */

    public function addPayment(int $method, float $amount, string $voucher = null)
    {
        $payment = $this->payments()->updateOrCreate([
            'cash_register_id'  => $this->cash_register_id,
            'order_id'          => $this->id,
            'payment_method_id' => $method,
        ],[
            'amount' => $amount,
            'voucher' => $voucher
        ]);


        if ($method == 5 &&  $amount > 0) {
            $card = GiftCard::findOrFail($voucher);
            $card->current_value = $card->current_value - $amount;
            $card->save();
        }

        return $payment;
    }

    public function addBillNumber()
    {
        if(trim(request()->bill_number) != '')
        {
            if (Resolution::where('status', true)->first()) {

                $resolution = Resolution::where('status', true)->first();

                request()->validate([
                    'bill_number' => 'nullable|integer|unique:bills,bill|max:'.$resolution->to
                ]);

                if ($this->bill) {
                    $bill                 = Bill::findOrFail($this->bill->id);
                    $bill->status         = false;
                    $bill->save();

                    $bill                 = new Bill();
                    $bill->order_id       = $this->id;
                    $bill->resolution_id  = $resolution->id;
                    $bill->bill           = request()->bill_number;
                    $bill->save();
                }
                else {
                    $bill                 = new Bill();
                    $bill->order_id       = $this->id;
                    $bill->resolution_id  = $resolution->id;
                    $bill->bill           = request()->bill_number;
                    $bill->save();
                }

                return $bill;
            }

        }

        return null;
    }
}
