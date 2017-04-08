<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Stock;
use Tests\FeatureTestCase;


class ListStocksTest extends FeatureTestCase
{
    function test_a_user_can_see_stock_list()
    {
        //having
        $stock = factory(Stock::class)->create();
        $this->actingAs($this->defaultUser());
        //when
        $this->visit(route('stocks.index'));
        //then
        $this->see('Existencias')
        ->seeInElement('td', $stock->detail->product->id)
        ->seeInElement('td', $stock->detail->product->name)
        ->seeInElement('td', $stock->detail->sale_price)
        ->seeInElement('td', $stock->detail->due_date)
        ->seeInElement('td', $stock->stock);
    }
}
