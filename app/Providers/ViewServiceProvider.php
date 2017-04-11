<?php

namespace EmejiasInventory\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        view()->composer(
            [
                'products/create',
                'products/edit',
                'products/index',
                'orders/details/create',
                'audit/details/create',
                'stocks/index',
            ],
            'EmejiasInventory\Http\ViewComposers\ProductsComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
