<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::name($request->name)->orderBy('id', 'DESC')->paginate();
        return view('users.index', compact('users'));
    }
}
