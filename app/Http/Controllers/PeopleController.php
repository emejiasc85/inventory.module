<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $people = People::name($request->get('name'))->orderBy('id', 'DESC')->paginate();

        return view('people.index', compact('people'));
    }

    public function autoComplete(Request $request)
    {
        $term = $request->get('term');
         return People::select('id', 'name', 'nit', 'address')
            ->where('nit', 'LIKE', "%$term%")
            ->get();
    }
}
