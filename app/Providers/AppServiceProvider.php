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

        // Paginator::useBootstrapFive();

        //can ues Gate:denied/Gate:allow to handle logic myself | User defined is always the authorized user never a guest
//        Gate::define('edit-job', function (User $user, Job $job) {
//            return $job->employer->user->is($user);
//        });
    }
}
