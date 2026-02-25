<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Colocation;
use App\Policies\ColocationPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Colocation::class => ColocationPolicy::class,
    ];

    public function boot(): void
    {
        Gate::define('is-admin', function ($user) {
            return $user->email === 'admin@example.com';
        });
    }
}
