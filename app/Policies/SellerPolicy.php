<?php

namespace App\Policies;

use App\Models\User;

class SellerPolicy
{
    public function viewAny(User $authUser): bool
    {
        return $authUser->role->name === 'admin';
    }

    public function create(User $authUser): bool
    {
        return $authUser->role->name === 'admin';
    }
}
