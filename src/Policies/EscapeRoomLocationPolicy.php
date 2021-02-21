<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\EscapeRoom\Models\EscapeRoomLocation;
use Tipoff\Support\Contracts\Models\UserInterface;

class EscapeRoomLocationPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view escape room locations');
    }

    public function view(UserInterface $user, EscapeRoomLocation $escapeRoomLocation): bool
    {
        return $user->hasPermissionTo('view escape room locations');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create escape room locations');
    }

    public function update(UserInterface $user, EscapeRoomLocation $escapeRoomLocation): bool
    {
        return $user->hasPermissionTo('update escape room locations');
    }

    public function delete(UserInterface $user, EscapeRoomLocation $escapeRoomLocation): bool
    {
        return false;
    }

    public function restore(UserInterface $user, EscapeRoomLocation $escapeRoomLocation): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, EscapeRoomLocation $escapeRoomLocation): bool
    {
        return false;
    }
}
