<?php

namespace Modules\ProductStockNowAfter\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\Product\Entities\Product;
use Modules\ProductStockNowAfter\Entities\ProductStockNowAfter;

class ProductStockNowAfterServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        Product::addDynamicRelation('product_stock_now_after', function (Product $product) {
            return $product->hasOne(ProductStockNowAfter::class);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ObserverServiceProvider::class);
        $this->app->register(ViewComposerServiceProvider::class);
    }


    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/productstocknowafter');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/productstocknowafter';
        }, \Config::get('view.paths')), [$sourcePath]), 'productstocknowafter');
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
