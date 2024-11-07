<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use TomatoPHP\FilamentSubscriptions\Events\ChangePlan;
use Illuminate\Queue\InteractsWithQueue;

class HandleChangePlan
{
    /**
     * Handle the event.
     *
     * @param  \TomatoPHP\FilamentSubscriptions\Events\ChangePlan  $event
     * @return void
     */
    public function handle(ChangePlan $event)
    {
        $oldPlan = $event->old;
        $newPlan = $event->new;
        $subscription = $event->subscription;

        // Log the plan change
        Log::info('User has changed their plan', [
            'old_plan' => $oldPlan,
            'new_plan' => $newPlan,
            'subscription' => $subscription,
        ]);

        // You can add additional logic here (e.g., send notifications)
    }
}