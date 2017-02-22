<?php
namespace EmejiasInventory\Http\ViewComposers;

use EmejiasInventory\Entities\{ProductPresentation, ProductGroup, UnitMeasure};

/**
*
*/
class ProductsComposer
{
	public function compose($view)
	{
		$view->presentations = ProductPresentation::pluck('name', 'id')->toArray();
    	$view->groups = ProductGroup::pluck('name', 'id')->toArray();
    	$view->units  = UnitMeasure::pluck('name', 'id')->toArray();
	}
}
