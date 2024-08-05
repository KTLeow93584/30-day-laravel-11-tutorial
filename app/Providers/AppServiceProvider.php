<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Models\User;
use App\Models\Job;

use App\Listeners\SendOrderConfirmation;
use App\Events\OrderPlaced;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();
        Paginator::useTailwind();

        // Gates which allow guests to pass. (Use the ? mark)
        //Gate::define('edit-job', function (?User $user, Job $job) {
        //return $job->employer->user->is($user);
        //});

        // Gate::define('edit-job', function (User $user, Job $job) {
        //     return $job->employer->user->is($user);
        // });
    }
}
