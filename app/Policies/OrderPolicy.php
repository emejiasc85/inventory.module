<?php

namespace EmejiasInventory\Policies;

use EmejiasInventory\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function update($user, $order)
    {
        return $user->isAuthor($order);
    }

    public function destroy($user, $order)
    {
        return $user->isAuthor($order);
    }
}
