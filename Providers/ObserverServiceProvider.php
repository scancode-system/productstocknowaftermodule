<?php

namespace Modules\ProductStockNowAfter\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Product\Entities\Product;
use Modules\ProductStockNowAfter\Observers\ProductObserver;
use Modules\Order\Entities\Item;
use Modules\ProductStockNowAfter\Observers\ItemObserver;

class ObserverServiceProvider extends ServiceProvider {

	public function boot() {
		Product::observe(ProductObserver::class);
		Item::observe(ItemObserver::class);
	}

	public function register() {
        //
	}

}
