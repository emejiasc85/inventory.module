<?php

namespace EmejiasInventory\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginateIf();
        return UserResource::collection($users);
    }
}
