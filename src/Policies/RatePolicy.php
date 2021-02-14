<?php

namespace Tipoff\EscapeRoom\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\EscapeRoom\Models\Rate;
use Tipoff\Support\Contracts\Models\UserInterface;

class RatePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view rates') ? true : false;
    }

    public function view(UserInterface $user, Rate $rate)
    {
        return $user->hasPermissionTo('view rates') ? true : false;
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create rates') ? true : false;
    }

    public function update(UserInterface $user, Rate $rate)
    {
        return $user->hasPermissionTo('update rates') ? true : false;
    }

    public function delete(UserInterface $user, Rate $rate)
    {
        return false;
    }

    public function restore(UserInterface $user, Rate $rate)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Rate $rate)
    {
        return false;
    }
}
