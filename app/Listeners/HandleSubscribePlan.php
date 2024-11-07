<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use TomatoPHP\FilamentSubscriptions\Events\SubscribePlan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmation;


class HandleSubscribePlan
{
    /**
     * Handle the event.
     *
     * @param  \TomatoPHP\FilamentSubscriptions\Events\SubscribePlan  $event
     * @return void
     */
    public function handle(SubscribePlan $event)
    {
        $newPlan = $event->new;
        $subscription = $event->subscription;

        // Log the new subscription
        Log::info('User has subscribed to a new plan.', [
            'new_plan' => $newPlan,
            'subscription' => $subscription,
        ]);

        // Optionally, send a welcome email
        Mail::to($subscription->user->email)->send(new SubscriptionConfirmation($subscription));

        // Perform any additional logic, such as activating the subscription
        $subscription->status = 'active';
        $subscription->save();
    }
}