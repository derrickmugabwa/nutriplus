<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentSubscriptions\Facades\FilamentSubscriptions;
use TomatoPHP\FilamentSubscriptions\Services\Contracts\Subscriber;
use TomatoPHP\FilamentPayments\Services\Contracts\PaymentBillingInfo;
use TomatoPHP\FilamentPayments\Facades\FilamentPayments;
use TomatoPHP\FilamentPayments\Services\Contracts\PaymentRequest;
use TomatoPHP\FilamentPayments\Services\Contracts\PaymentCustomer;


class SubscriptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        FilamentSubscriptions::register(
            Subscriber::make(\App\Models\User::class)
                ->name('User')
                ->model(\App\Models\User::class)
        );

        FilamentSubscriptions::afterSubscription(function ($data) {
            // Handle the payment process here
            return redirect()->to(FilamentPayments::pay(
                data: PaymentRequest::make(Plan::class)
                    ->model_id($data['new']->id)
                    ->currency('USD')
                    ->amount($data['new']->price)
                    ->details('Subscription Payment')
                    ->success_url(url('/success'))
                    ->cancel_url(url('/cancel'))
                    ->customer(
                        PaymentCustomer::make('John Doe')
                            ->email('john@gmail.com')
                            ->mobile('+201207860084')
                    )
                    ->billing_info(
                        PaymentBillingInfo::make('123 Main St')
                            ->area('Downtown')
                            ->city('Cairo')
                            ->state('Cairo')
                            ->postcode('12345')
                            ->country('EG')
                    )
                    ->shipping_info(
                        PaymentShippingInfo::make('123 Main St')
                            ->area('Downtown')
                            ->city('Cairo')
                            ->state('Cairo')
                            ->postcode('12345')
                            ->country('EG')
                    )
            ));
        });
    }
}