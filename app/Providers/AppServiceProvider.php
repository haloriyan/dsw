<?php

namespace App\Providers;

use Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('currency', function ($number) {
            return "<?= 'Rp '.strrev(implode('.',str_split(strrev(strval($number)),3))) ?>";
        });

        Blade::directive('toK', function ($number) {
            return "<?= $number / 1000 ?>";
        });
    }
}
