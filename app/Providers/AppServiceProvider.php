<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Interfaces\PreferenceRepositoryInterface','App\Repositories\PreferenceRepository');
        $this->app->bind('App\Repositories\Interfaces\PreferenceItemRepositoryInterface','App\Repositories\PreferenceItemRepository');
        $this->app->bind('App\Repositories\Interfaces\PreferencPayerRepositoryInterface','App\Repositories\PreferencePayerRepository');
        $this->app->bind('App\Repositories\Interfaces\PreferenceBackUrlRepositoryInterface','App\Repositories\PreferenceBackUrlRepository');
        $this->app->bind('App\Repositories\Interfaces\PreferencePaymentMethodRepositoryInterface','App\Repositories\PreferencePaymentMethodRepository');
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
