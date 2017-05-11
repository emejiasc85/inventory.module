<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Role;
use EmejiasInventory\Entities\User;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditUserController extends Controller
{
    protected $rules = [
        'name'     => 'required',
        'username' => 'required',
        'email'    => 'required'
    ];

    function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id')->toArray();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, $this->rules);
        $user->fill($request->all());
        $user->save();
        Alert::succes('Usuario editado correctamente');
        return redirect()->route('users.index');
    }

    public function editPassword(User $user)
    {
        return view('users.edit_password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->validate($request, ['password' => 'required', 'password_confirmation' => 'required']);
        $user->fill($request->all());
        $user->save();
        Alert::succes('Usuario editado correctamente');
        return redirect()->route('users.index');
    }

    public function editAuthPassword(User $user)
    {
        return view('users.edit_auth_password', compact('user'));
    }

    public function updateAuthPassword(Request $request, User $user)
    {

        $this->validate($request, [
            'password' => 'required',
            'password_confirmation' => 'required',
            'current_password' => 'current_password'
        ]);
        $user->password = $request->get('password');
        $user->save();
        Alert::success('Contraseña cambiada con exito');
        return redirect('/');
    }
}
