<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use TomatoPHP\FilamentSubscriptions\Events\RequestPlan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlanRequestNotification;

class HandleRequestPlan
{
    /**
     * Handle the event.
     *
     * @param  \TomatoPHP\FilamentSubscriptions\Events\RequestPlan  $event
     * @return void
     */
    public function handle(RequestPlan $event)
    {
        $oldPlan = $event->old;
        $newPlan = $event->new;
        $subscription = $event->subscription;

        // Log the plan request
        Log::info('User has requested a new plan.', [
            'old_plan' => $oldPlan,
            'new_plan' => $newPlan,
            'subscription' => $subscription,
        ]);

        // Optionally, send an admin notification about the plan request
        Mail::to('admin@site.com')->send(new PlanRequestNotification($subscription, $newPlan));
    }
}