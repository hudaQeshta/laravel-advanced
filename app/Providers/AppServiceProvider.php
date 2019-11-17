<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use Illuminate\Support\ServiceProvider;
use App\Billing\PaymentGatewayContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //app >> the entire app
        //whenever anyone wants the PaymentGatewayContract , here is the concrete implementation of it 
        $this->app->singleton(PaymentGatewayContract::class, function($app) {
            //pass in the currency
            //Concrete implementation of PaymentGatewayContract
            if(request()->has('credit')){
            return new CreditPaymentGateway('usd');
        }
            return new BankPaymentGateway('usd');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
