<?php

namespace App\Policies;

use Tipoff\EscapeRoom\Models\Participant;
use Tipoff\Support\Contracts\Models\UserInterface;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParticipantPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view participants') ? true : false;
    }

    public function view(UserInterface $user, Participant $participant)
    {
        return $user->hasPermissionTo('view participants') ? true : false;
    }

    public function create(UserInterface $user)
    {
        return false;
    }

    public function update(UserInterface $user, Participant $participant)
    {
        return false;
    }

    public function delete(UserInterface $user, Participant $participant)
    {
        return false;
    }

    public function restore(UserInterface $user, Participant $participant)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Participant $participant)
    {
        return false;
    }
}
