<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\EscapeRoom\Models\EscaperoomRate;
use Tipoff\Support\Contracts\Models\UserInterface;

class EscaperoomRatePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view rates') ? true : false;
    }

    public function view(UserInterface $user, EscaperoomRate $rate): bool
    {
        return $user->hasPermissionTo('view rates') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create rates') ? true : false;
    }

    public function update(UserInterface $user, EscaperoomRate $rate): bool
    {
        return $user->hasPermissionTo('update rates') ? true : false;
    }

    public function delete(UserInterface $user, EscaperoomRate $rate): bool
    {
        return false;
    }

    public function restore(UserInterface $user, EscaperoomRate $rate): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, EscaperoomRate $rate): bool
    {
        return false;
    }
}
