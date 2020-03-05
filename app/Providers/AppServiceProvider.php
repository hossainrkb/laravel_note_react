<?php

namespace App\Providers;

use App\Model\Piproduct;
use App\Billing_Payments\BankPayment;
use App\s_container\ServiceContainer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Billing_Payments\PaymentInterface;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ServiceContainer::class, function(){
            return new ServiceContainer(new Piproduct());
        });
        $this->app->bind(PaymentInterface::class, function(){
            return new BankPayment("BDT");
        });
        // $this->app->bind("Hello", function(){
        //     return "New Day";
        // });
        $this->app->tag(['Hello', 'MemoryReport'], 'reports');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Resource::withoutWrapping();

         Schema::defaultStringLength(191);
    }
}
