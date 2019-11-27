<?php

namespace Modules\ProductStockNowAfter\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\ProductStockNowAfter\Http\ViewComposers\EditComposer;

class ViewComposerServiceProvider extends ServiceProvider {

	public function boot() {
		View::composer('product::edit', EditComposer::class);
	}

	public function register() {
        //
	}

}
