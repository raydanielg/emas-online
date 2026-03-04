<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Gate::before(function ($user, $ability) {
            if (Str::startsWith($ability, 'role:')) {
                $role = Str::after($ability, 'role:');
                return $user->hasRole($role);
            }

            if (Str::startsWith($ability, 'permission:')) {
                $permission = Str::after($ability, 'permission:');
                return $user->can($permission);
            }

            if (Str::startsWith($ability, 'role_or_permission:')) {
                $value = Str::after($ability, 'role_or_permission:');

                $parts = array_filter(array_map('trim', explode('|', $value)));
                foreach ($parts as $part) {
                    if ($user->hasRole($part) || $user->can($part)) {
                        return true;
                    }
                }

                return false;
            }

            return null;
        });
    }
}
