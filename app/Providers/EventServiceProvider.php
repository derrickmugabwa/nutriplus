<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Register your events and listeners here
        \TomatoPHP\FilamentSubscriptions\Events\ChangePlan::class => [
            \App\Listeners\HandleChangePlan::class,
        ],
        \TomatoPHP\FilamentSubscriptions\Events\CancelPlan::class => [
            \App\Listeners\HandleCancelPlan::class,
        ],
        \TomatoPHP\FilamentSubscriptions\Events\RequestPlan::class => [
            \App\Listeners\HandleRequestPlan::class,
        ],
        \TomatoPHP\FilamentSubscriptions\Events\SubscribePlan::class => [
            \App\Listeners\HandleSubscribePlan::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
