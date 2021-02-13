<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\Support\Contracts\Models\UserInterface;

class RoomPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view rooms') ? true : false;
    }

    public function view(UserInterface $user, Room $room): bool
    {
        return $user->hasPermissionTo('view rooms') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create rooms') ? true : false;
    }

    public function update(UserInterface $user, Room $room): bool
    {
        return $user->hasPermissionTo('update rooms') ? true : false;
    }

    public function delete(UserInterface $user, Room $room): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Room $room): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Room $room): bool
    {
        return false;
    }
}