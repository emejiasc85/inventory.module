<?php
namespace EmejiasInventory\Http\ViewComposers;

use EmejiasInventory\Entities\{ProductPresentation, ProductGroup, UnitMeasure, Make};
use EmejiasInventory\Entities\Category;

/**
*
*/
class ProductsComposer
{
	public function compose($view)
	{
		$view->makes = Make::pluck('name', 'id')->toArray();
		$view->presentations = ProductPresentation::pluck('name', 'id')->toArray();
    	$view->groups = ProductGroup::pluck('name', 'id')->toArray();
    	$view->units  = UnitMeasure::pluck('name', 'id')->toArray();
    	$view->categories  = Category::pluck('name', 'id')->toArray();
	}
}
