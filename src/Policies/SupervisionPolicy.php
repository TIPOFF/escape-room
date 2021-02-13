<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\Support\Contracts\Models\UserInterface;

class SupervisionPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view supervisions') ? true : false;
    }

    public function view(UserInterface $user, Supervision $supervision): bool
    {
        return $user->hasPermissionTo('view supervisions') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create supervisions') ? true : false;
    }

    public function update(UserInterface $user, Supervision $supervision): bool
    {
        return $user->hasPermissionTo('update supervisions') ? true : false;
    }

    public function delete(UserInterface $user, Supervision $supervision): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Supervision $supervision): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Supervision $supervision): bool
    {
        return false;
    }
}