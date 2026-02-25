<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Colocation;

class ColocationPolicy
{
    public function view(User $user, Colocation $colocation)
    {
        return $colocation->activeMembers()->where('user_id', $user->id)->exists();
    }

    public function manage(User $user, Colocation $colocation)
    {
        return $colocation->owner_id === $user->id;
    }

    public function create(User $user)
    {
        return !$user->activeColocation();
    }
}
