<?php

namespace Modules\ProductStockNowAfter\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\ProductStockNowAfter\Http\ViewComposers\EditComposer;
use Modules\ProductStockNowAfter\Http\ViewComposers\Loader\Order\ViewProductStockNowAfterComposer;
use Modules\ProductStockNowAfter\Http\ViewComposers\Loader\Order\ViewComposer;

class ViewComposerServiceProvider extends ServiceProvider {

	public function boot() {
		View::composer([
			'product::edit',
			'productstocknowafter::loader.products.tr', 
			'productstocknowafter::loader.products.view'], EditComposer::class);

		View::composer('productstocknowafter::loader.order.view_product_stock_now_after', ViewProductStockNowAfterComposer::class);
		View::composer('productstocknowafter::loader.order.view', ViewComposer::class);
	}

	public function register() {
        //
	}

}
