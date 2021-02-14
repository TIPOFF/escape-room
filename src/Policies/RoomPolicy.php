<?php

namespace Tipoff\EscapeRoom\Policies;

use Tipoff\EscapeRoom\Models\Room;
use Tipoff\Support\Contracts\Models\UserInterface;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view rooms') ? true : false;
    }

    public function view(UserInterface $user, Room $room)
    {
        return $user->hasPermissionTo('view rooms') ? true : false;
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create rooms') ? true : false;
    }

    public function update(UserInterface $user, Room $room)
    {
        return $user->hasPermissionTo('update rooms') ? true : false;
    }

    public function delete(UserInterface $user, Room $room)
    {
        return false;
    }

    public function restore(UserInterface $user, Room $room)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Room $room)
    {
        return false;
    }
}
