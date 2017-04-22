<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Role,User};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateUserController extends Controller
{
    protected $rules = [
        'name'     => 'required',
        'username' => 'required|unique:users,username',
        'email'    => 'email|required|unique:users,email',
        'password' => 'required|confirmed',
        'role_id'  => 'required|exists:roles,id'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id')->toArray();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $user = User::create($request->all());
        Alert::success('Usuario creado correctamente');
        return redirect('/');
    }
}
