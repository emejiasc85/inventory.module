<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\People;
use EmejiasInventory\Entities\ProductGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $people = People::name($request->get('name'))->orderBy('id', 'DESC')->paginate();

        return view('people.index', compact('people'));
    }

    public function autoComplete($people)
    {
        $search =  People::select('id', 'name', 'nit', 'address')
            ->where('nit',  $people)
            ->get();
        if ($search->first()) 
        {
            return response()->json([
                'success' => true,
                'people' => $search->first()
            ]);
        }
        return response()->json([
            'success' => false,
        ]);

    }

    public function profile(People $people, $slug)
    {

        $bills = Order::select('orders.*')
            ->where('order_type_id', 2)
            ->where('orders.status', 'Ingresado')
            ->peopleId($people->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $groups = ProductGroup::select('product_groups.name')
                ->leftJoin('products', 'products.product_group_id', '=', 'product_groups.id' )
                ->leftJoin('order_details', 'order_details.product_id', '=', 'products.id' )
                ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id' )
                ->leftJoin('people', 'people.id', '=', 'orders.people_id' )
                ->where('people.id', $people->id)
                ->groupBy('product_groups.name')
                ->get();

        return view('people.profile', compact('people', 'bills', 'groups'));
    }

    public function avatar(People $people)
    {
        $header = [
            'Content-lenght'  => File::size($people->avatarFile),
            'Content-type'    => File::mimeType($people->avatarFile)
          ];
        return response()->download(
            $people->avatarFile,
            null, $header, ResponseHeaderBag::DISPOSITION_INLINE
        );
    }
}
