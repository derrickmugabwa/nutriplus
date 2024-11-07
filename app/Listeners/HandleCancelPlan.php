<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use TomatoPHP\FilamentSubscriptions\Events\CancelPlan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionCancelled;

class HandleCancelPlan
{
    /**
     * Handle the event.
     *
     * @param  \TomatoPHP\FilamentSubscriptions\Events\CancelPlan  $event
     * @return void
     */
    public function handle(CancelPlan $event)
    {
        $oldPlan = $event->old;
        $subscription = $event->subscription;

        // Log the cancellation
        Log::info('User has cancelled their subscription.', [
            'old_plan' => $oldPlan,
            'subscription' => $subscription,
        ]);

        // Optionally, send an email notification
        Mail::to($subscription->user->email)->send(new SubscriptionCancelled($subscription));

        // Update the user's subscription status (if needed)
        $subscription->status = 'cancelled';
        $subscription->save();
    }
}