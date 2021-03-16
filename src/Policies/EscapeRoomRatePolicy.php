<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\EscapeRoom\Models\EscapeRoomRate;
use Tipoff\Support\Contracts\Models\UserInterface;

class EscapeRoomRatePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view rates') ? true : false;
    }

    public function view(UserInterface $user, EscapeRoomRate $rate): bool
    {
        return $user->hasPermissionTo('view rates') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create rates') ? true : false;
    }

    public function update(UserInterface $user, EscapeRoomRate $rate): bool
    {
        return $user->hasPermissionTo('update rates') ? true : false;
    }

    public function delete(UserInterface $user, EscapeRoomRate $rate): bool
    {
        return false;
    }

    public function restore(UserInterface $user, EscapeRoomRate $rate): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, EscapeRoomRate $rate): bool
    {
        return false;
    }
}
