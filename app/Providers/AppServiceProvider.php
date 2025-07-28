<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
         Gate::define('isAdmin' , function(User $user)
        {
                return $user->role === 'admin';
        });
        
           Gate::define('show-profile' , function(User $user , $profileId)
        {
                return $user->id === $profileId;
        });


        //Used the below gate in this project till now.
         Gate::define('is-authenticated-user' , function(User $user , $profileId)
        {
                return $user->id === $profileId;
        });
    }
}
