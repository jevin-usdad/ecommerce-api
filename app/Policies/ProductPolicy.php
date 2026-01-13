<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;


class ProductPolicy
{
    public function viewPdf(User $user, Product $product): bool
    {
        if ($user->role->name === 'seller') {
            return true;
        }

        return $product->seller_id === $user->id;
    }
}
