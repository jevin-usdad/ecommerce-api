<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Product;
use App\Policies\SellerPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class    => SellerPolicy::class,
        Product::class => ProductPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
