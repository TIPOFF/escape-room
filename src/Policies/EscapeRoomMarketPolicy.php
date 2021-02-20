<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\EscapeRoom\Models\EscapeRoomMarket;
use Tipoff\Support\Contracts\Models\UserInterface;

class EscapeRoomMarketPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view escape room markets');
    }

    public function view(UserInterface $user, EscapeRoomMarket $escapeRoomMarket): bool
    {
        return $user->hasPermissionTo('view escape room markets');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create escape room markets');
    }

    public function update(UserInterface $user, EscapeRoomMarket $escapeRoomMarket): bool
    {
        return $user->hasPermissionTo('update escape room markets');
    }

    public function delete(UserInterface $user, EscapeRoomMarket $escapeRoomMarket): bool
    {
        return false;
    }

    public function restore(UserInterface $user, EscapeRoomMarket $escapeRoomMarket): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, EscapeRoomMarket $escapeRoomMarket): bool
    {
        return false;
    }
}
