<?php

namespace Tipoff\EscapeRoom\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\EscapeRoom\Models\Theme;
use Tipoff\Support\Contracts\Models\UserInterface;

class ThemePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view themes') ? true : false;
    }

    public function view(UserInterface $user, Theme $theme)
    {
        return $user->hasPermissionTo('view themes') ? true : false;
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create themes') ? true : false;
    }

    public function update(UserInterface $user, Theme $theme)
    {
        return $user->hasPermissionTo('update themes') ? true : false;
    }

    public function delete(UserInterface $user, Theme $theme)
    {
        return false;
    }

    public function restore(UserInterface $user, Theme $theme)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Theme $theme)
    {
        return false;
    }
}
