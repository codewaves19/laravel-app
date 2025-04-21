<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
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
        Model::preventLazyLoading();
        // be careful there is preventsLazyLoading also which is not what we require…it returns a boolean value
        //Paginator::useBootstrapFive();
        Gate::define('edit-job', function (User $user, Job $job) { // this will always fail for guest users
            return $job->employer->user->is($user); // check even if you are not logged in 
        });
    }
}
